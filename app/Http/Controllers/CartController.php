<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $userId = Auth::id(); // Get the currently authenticated user's ID
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1; // Default quantity to 1 if not specified

        // Check if product is already in cart
        $cart = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
        if ($cart) {
            $cart->quantity += $quantity; // Update quantity if product exists
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart successfully!');
    }

    public function showCart() {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        return view('cart.show', compact('cartItems'));
    }

    public function updateCart(Request $request, $cartId) {
        $quantity = $request->quantity;
        Cart::where('id', $cartId)->update(['quantity' => $quantity]);

        return back()->with('success', 'Cart updated successfully!');
    }

    public function removeFromCart($cartId) {
        Cart::destroy($cartId);

        return back()->with('success', 'Product removed from cart successfully!');
    }

    public function checkout() {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->delete(); // Clear the cart after checkout

        // Placeholder for checkout logic
        return back()->with('success', 'Checkout successful!');
    }
}
