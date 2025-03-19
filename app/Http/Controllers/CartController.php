<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //add to card funcstionly
    public function addToCart(Request $request)
    {
        $product = $request->only(['name', 'price']);
        $cart = session()->get('cart', []);
        $cart[] = $product;
        session()->put('cart', $cart);
        return response()->json(['message' => 'Product added to cart successfully!', 'cart' => $cart]);
    }

    // get cart
    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json($cart);
    }

    // remove product from cart
    public function removeFromCart(Request $request)
    {
        $index = $request->index;

        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            array_splice($cart, $index, 1); 
            session()->put('cart', $cart);
        }

        return response()->json(['message' => 'Product removed from cart', 'cart' => $cart]);
    }
}
