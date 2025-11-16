<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Product;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Show subscription form or user's active subscription.
     */
    public function index(Request $request)
    {
        try {
            // Get token from session or cookie
            $token = session('user_token') ?? $request->cookie('user_token');
            if (!$token) {
                return redirect()->route('login')->with('error', 'Please login to continue.');
            }

            // Authenticate user using JWT
            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Invalid or expired session. Please login again.');
            }

            // Get user's active subscription
            $subscription = Subscription::where('user_id', $user->id)
                ->where('status', '!=', 'cancelled')
                ->latest()
                ->first();

            $products = Product::all();

            return view('subscription', compact('subscription', 'products'));

        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }
    }

    /**
     * Store a new subscription.
     */
    public function store(Request $request)
    {
        try {
            $token = session('user_token') ?? $request->cookie('user_token');
            if (!$token) {
                return redirect()->route('login')->with('error', 'Please login to continue.');
            }

            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Invalid session. Please login again.');
            }

            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'plan' => 'required|in:daily,weekly',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'payment_method' => 'required|in:cod,online',
            ]);

            Subscription::create([
                'user_id' => $user->id,
                'product_id' => $validated['product_id'],
                'plan' => $validated['plan'],
                'quantity' => $validated['quantity'],
                'price' => $validated['price'],
                'start_date' => Carbon::now(),
                'auto_renew' => true,
                'status' => 'active',
            ]);

            // Future: Handle payment logic here based on $validated['payment_method']

            return back()->with('success', 'Subscription activated successfully!');

        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Cancel an existing subscription.
     */
    public function cancel(Request $request, $id)
    {
        try {
            $token = session('user_token') ?? $request->cookie('user_token');
            if (!$token) {
                return redirect()->route('login')->with('error', 'Please login to continue.');
            }

            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Invalid session. Please login again.');
            }

            $subscription = Subscription::where('id', $id)
                ->where('user_id', $user->id)
                ->firstOrFail();

            $subscription->update(['status' => 'cancelled']);

            return back()->with('success', 'Subscription cancelled successfully.');

        } catch (Exception $e) {
            return back()->with('error', 'Unable to cancel subscription. Please try again.');
        }
    }
}
