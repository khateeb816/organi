<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function shopingCart(Request $request)
    {
        if ($request->discount) {
            $discount = coupon::where('code', $request->discount)->first();
            session(['discount' => $discount->id]);
            session(['discountPrecentage' => $discount->percentage]);
        } else {
            session()->forget('discount');
            session()->forget('discountPrecentage');
        }
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('frontend.shop.shopingCart', compact('carts'));
    }

    public function addToCart($id, $quantity = 1)
    {


        // Check if product already exists in cart
        $existingCart = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($existingCart) {
            // If product exists, update quantity
            $existingCart->increment('quantity', $quantity);
        } else {
            // If product doesn't exist, create a new entry
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
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
