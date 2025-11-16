<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;


class CartWishlistController extends Controller
{
    // Add to Cart
    public function addToCart(Request $request, $productId)
    {
        $userId = Auth::id();

        Cart::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $productId],
            ['quantity' => DB::raw('quantity + 1')]
        );

        return response()->json(['success' => true, 'message' => 'Product added to cart']);
    }

    // Add to Wishlist
    public function addToWishlist(Request $request, $productId)
    {
        $userId = Auth::id();

        Wishlist::firstOrCreate(
            ['user_id' => $userId, 'product_id' => $productId]
        );

        return response()->json(['success' => true, 'message' => 'Product added to wishlist']);
    }





    public function cart()
    {
        $userId = Auth::id();
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        return view('cart', compact('cartItems'));
    }


    // Update Cart Quantity
    public function updateCart(Request $request, $cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated']);
    }

    // Remove from Cart
    public function removeCart($cartId)
    {
        Cart::destroy($cartId);
        return response()->json(['success' => true, 'message' => 'Product removed from cart']);
    }

    public function wishlist()
    {
        $userId = Auth::id();
        $wishlistItems = Wishlist::with('product')
            ->where('user_id', $userId)
            ->get();

        return view('wishlist', compact('wishlistItems'));
    }

    // Remove from Wishlist
    public function removeWishlist($wishlistId)
    {
        Wishlist::destroy($wishlistId);
        return response()->json(['success' => true, 'message' => 'Product removed from wishlist']);
    }

    // Add to Cart from Wishlist
    public function addToCartFromWishlist(Request $request, $productId)
    {
        $userId = Auth::id();

        // Add to cart
        Cart::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $productId],
            ['quantity' => DB::raw('quantity + 1')]
        );

        // Optionally remove from wishlist
        Wishlist::where('user_id', $userId)->where('product_id', $productId)->delete();

        return response()->json(['success' => true, 'message' => 'Product added to cart']);
    }

}
