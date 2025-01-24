<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function shopingCart()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->with('product')->get();
        return view('frontend.shop.shopingCart', compact('carts'));
    }

    public function addToCart($id , $quanity = 1)
    {
        Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $id,
            'quantity' => $quanity,
        ]);
        return redirect()->back();
    }

    public function removeCartItem($id)
    {
        Cart::find($id)->delete();
        return redirect()->back();
    }

    public function updateCartItem(Request $request)
    {

        $request->validate([
            'cart.*.cart_id' => 'required|exists:carts,id',
            'cart.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($request->cart as $item) {
            $cart = Cart::find($item['cart_id']);
            $cart->quantity = $item['quantity'];
            $cart->save();
        }
        return response()->json(['success' => true]);
    }
}
