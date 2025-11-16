<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Address;
use App\Models\DeliverySlot;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    public function checkout()
    {
        $userId = Auth::id();
        Log::info("Checkout page visited by user: {$userId}");

        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        $addresses = Address::where('user_id', $userId)->get();
        $slots = DeliverySlot::where('is_active', true)->get();
        $subscription = Subscription::where('user_id', $userId)
            ->where('status', '!=', 'cancelled')
            ->latest()
            ->first();

        return view('checkout', compact('cartItems', 'addresses', 'slots', 'subscription'));
    }

    public function placeOrder(Request $request)
    {
        $userId = Auth::id();
        Log::info("Placing order by user: {$userId}", $request->all());

        $request->validate([
            'address_id' => 'nullable|exists:addresses,id',
            'delivery_slot_id' => 'required|exists:delivery_slots,id',
            'payment_method' => 'required|string',
        ]);

        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            Log::warning("User {$userId} cart is empty on placeOrder");
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        // Subscription check
        $subscription = null;
        if ($request->payment_method === 'subscription') {
            $subscription = Subscription::where('user_id', $userId)
                ->where('status', 'active')
                ->latest()
                ->first();

            if (!$subscription) {
                Log::warning("User {$userId} tried subscription payment but has no active subscription");
                return redirect()->back()->with('error', 'No active subscription available for payment.');
            }
        }

        // Stripe payment
        if ($request->payment_method === 'online') {
            return $this->createStripeSession($request);
        }

        // COD or subscription
        DB::beginTransaction();
        try {
            // Address
            if (!$request->address_id && $request->address_line) {
                $address = Address::create([
                    'user_id' => $userId,
                    'address_line' => $request->address_line,
                    'city' => $request->city,
                    'state' => $request->state,
                    'pincode' => $request->pincode,
                    'landmark' => $request->landmark,
                    'is_default' => true,
                ]);
                $addressId = $address->id;
                Log::info("New address created: {$addressId} for user {$userId}");
            } else {
                $addressId = $request->address_id;
            }

            // Total calculation
            $total = 0;
            foreach ($cartItems as $item) {
                if ($item->product->quantity < $item->quantity) {
                    throw new \Exception("Product {$item->product->name} does not have enough quantity");
                }
                $total += $item->quantity * $item->product->price;
            }

            if ($request->payment_method === 'subscription') {
                if ($subscription->quantity < $cartItems->sum('quantity')) {
                    return redirect()->back()->with('error', 'Your subscription does not have enough quantity to cover this order.');
                }
            }

            // Create Order
            $order = Order::create([
                'user_id' => $userId,
                'address_id' => $addressId,
                'delivery_slot_id' => $request->delivery_slot_id,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'total_amount' => $total,
                'payment_status' => ($request->payment_method === 'cod' || $request->payment_method === 'subscription') ? 'pending' : 'paid',
                'order_status' => 'pending',
            ]);
            Log::info("Order created: {$order->id} by user {$userId}");

            OrderStatusHistory::create([
                'order_id' => $order->id,
                'updated_by' => null,
                'status' => 'pending',
                'note' => 'Order placed by user',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->quantity * $item->product->price,
                ]);

                $item->product->decrement('quantity', $item->quantity);
                if ($request->payment_method === 'subscription') {
                    $subscription->decrement('quantity', $item->quantity);
                }
            }

            Cart::where('user_id', $userId)->delete();
            DB::commit();

            return redirect()->route('home')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Place order error for user {$userId}: " . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function createStripeSession(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        Log::info("Creating Stripe session for user {$userId}");

        if ($cartItems->isEmpty()) {
            Log::warning("Cart empty for user {$userId} on Stripe session");
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->product->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.stripeSuccess', [
                    'address_id' => $request->address_id,
                    'delivery_slot_id' => $request->delivery_slot_id,
                ]),
                'cancel_url' => route('checkout'),
            ]);

            Log::info("Stripe session created for user {$userId}, session id: {$session->id}");
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error("Stripe session error for user {$userId}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Stripe session failed: ' . $e->getMessage());
        }
    }

    public function stripeSuccess(Request $request)
    {
        Log::info("Stripe success called");

        $user = null;
        $token = session('user_token');
        if ($token) {
            try {
                $user = JWTAuth::setToken($token)->authenticate();
            } catch (\Exception $e) {
                Log::error("Stripe success: JWT invalid or expired - " . $e->getMessage());
            }
        }

        if (!$user) {
            return redirect()->route('checkout')->with('error', 'User not authenticated');
        }

        $userId = $user->id;

        if (!$userId) {
            Log::error("Stripe success: user not logged in");
            return redirect()->route('checkout')->with('error', 'User not authenticated');
        }

        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            Log::warning("Cart empty on Stripe success for user {$userId}");
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }

        $addressId = $request->query('address_id');
        $deliverySlotId = $request->query('delivery_slot_id');

        Log::info("Stripe success parameters: address_id={$addressId}, delivery_slot_id={$deliverySlotId}");

        $address = Address::find($addressId);
        if (!$address) {
            Log::error("Stripe success: address not found {$addressId}");
            return redirect()->route('checkout')->with('error', 'No shipping address found.');
        }

        if (!$deliverySlotId) {
            Log::error("Stripe success: delivery slot missing");
            return redirect()->route('checkout')->with('error', 'No delivery slot selected.');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cartItems as $item) {
                if ($item->product->quantity < $item->quantity) {
                    throw new \Exception("Product {$item->product->name} does not have enough quantity");
                }
                $total += $item->quantity * $item->product->price;
            }

            $order = Order::create([
                'user_id' => $userId,
                'address_id' => $address->id,
                'delivery_slot_id' => $deliverySlotId,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'total_amount' => $total,
                'payment_status' => 'completed',
                'order_status' => 'pending',
            ]);
            Log::info("Stripe order created: {$order->id}");

            OrderStatusHistory::create([
                'order_id' => $order->id,
                'updated_by' => null,
                'status' => 'pending',
                'note' => 'Order placed by user via Stripe',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->quantity * $item->product->price,
                ]);

                $item->product->decrement('quantity', $item->quantity);
            }

            Cart::where('user_id', $userId)->delete();
            DB::commit();

            Log::info("Stripe order committed successfully for user {$userId}");
            return redirect()->route('home')->with('success', 'Stripe payment successful! Order placed.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Stripe success error for user {$userId}: " . $e->getMessage());
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
    }

    public function myOrders()
    {
        $userId = Auth::id();
        $orders = Order::with('orderItems', 'address', 'deliverySlot', 'statusHistory')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('myorder', compact('orders'));
    }

    public function cancelOrder(Request $request, $orderId)
    {
        $userId = Auth::id();
        $order = Order::where('id', $orderId)->where('user_id', $userId)->firstOrFail();

        if (in_array($order->order_status, ['cancelled', 'delivered'])) {
            return redirect()->back()->with('error', 'Order cannot be cancelled');
        }

        $order->order_status = 'cancelled';
        $order->save();

        OrderStatusHistory::create([
            'order_id' => $order->id,
            'updated_by' => $userId,
            'status' => 'cancelled',
            'note' => 'Cancelled by user'
        ]);

        return redirect()->back()->with('success', 'Order cancelled successfully!');
    }
}
