<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Profile;

class OrderController extends Controller
{
    public function saveorderdetails(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed.');
        }

        $request->validate([
            'discount'  => 'nullable|numeric|min:0',
            'total'     => 'required|numeric|min:1',
            'name'      => 'required|string|max:255',
            'country'   => 'required|string|max:255',
            'address'   => 'required|string|max:500',
            'city'      => 'required|string|max:100',
            'state'     => 'required|string|max:100',
            'postcode'  => 'required|numeric|digits_between:4,10',
            'phone'     => 'required|numeric|digits_between:10,15',
        ]);

        // New Order Create Karna

        $order = Order::insertGetid([
            'user_id' => Auth::id(),
            'discount' => $request->discount,
            'total' => $request->total,
            'status' => 'pending',
        ]);

        $carts = Cart::where('user_id', Auth::id())->get();
        foreach ($carts as $cart) {
            OrderDetail::insert([
                'order_id' => $order,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
            ]);
        };

        $profile = Profile::where('user_id', Auth::id())->first();
        if ($profile) {
            $profile::update([
                'name' => $request->name,
                'country' => $request->country,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'phone' => $request->phone,
                'user_id' => Auth::id(),
            ]);
        } else {
            Profile::insert([
                'name' => $request->name,
                'country' => $request->country,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'phone' => $request->phone,
                'user_id' => Auth::id(),
            ]);
        }


        // dd($order);

        $cart = Cart::where('user_id', Auth::id())->delete();


        return redirect('/paymentform/' . $order)->with('success', 'Order placed successfully!');
    }

    public function showpaymentform($id)
    {
        $order = Order::find($id);
        return view('frontend.checkout.payment', compact('order'));
    }

    public function checkoutForm()
    {
        $products = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('frontend.checkout.index', compact('products'));
    }

    public function savePayment(Request $request)
    {
        $request->validate([
            'order_id'    => 'required|exists:orders,id',
            'card_name'   => 'required|string|max:255',
            'card_number' => 'required|numeric', // Removed digits limit
            'card_expiry' => 'required|string', // Updated regex delimiter
            'card_cvv'    => 'required|numeric', // Removed digits limit
        ]);

        // Save payment details
        Payment::create([
            'order_id'    => $request->order_id,
            'card_name'   => $request->card_name,
            'card_number' => ($request->card_number), // Encrypt card details
            'card_expiry' => $request->card_expiry,
            'card_cvv'    => ($request->card_cvv),
        ]);

        return redirect()->back()->with('success', 'Payment completed successfully!');
    }

    // public function saveprofiledetails (Request $request)
    // {

    //     $request->validate([
    //         'name' => 'required',
    //         'country' => 'required',
    //         'address' => 'required',
    //         'city' => 'required',
    //         'state' => 'required',
    //         'postcode' => 'required',
    //         'phone' => 'required',
    //     ]);

    //     Profile::insert([
    //         'name' => $request->,
    //         'country' => $request->,
    //         'address' => $request->,
    //         'city' => $request->,
    //         'state' => $request->,
    //         'postcode' => $request->,
    //         'phone' => $request->,
    //     ]);


    // }

    public function showorders()
    {
        $orders = Order::with('product', 'payment')->get();
        return view('backend.admin.order.index', compact('orders'));
    }

    public function showorderdetails($id)
    {

        $order = Order::with(['orderdetails.product' , 'user', 'payment'])
        ->find($id);
        return view('backend.admin.order.view', compact('order'));
    }
    public function updateorderstatus(Request $request,$id)
    {
        $order=Order::find($id);
        $order->status=$request->status;
        $order->save();

    return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
