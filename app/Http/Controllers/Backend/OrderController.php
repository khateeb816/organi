<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller
{
    public function saveorderdetails(Request $request)
    {
        $request->validate([
            'discount'  => 'nullable',
            'total'     => 'required',
            'name'      => 'required',
            'country'   => 'required',
            'address'   => 'required',
            'city'      => 'required',
            'state'     => 'required',
            'postcode'  => 'required',
            'phone'     => 'required',
        ]);

        // Create a new order
        $orderId = Order::insertGetId([
            'user_id' => Auth::id(),
            'discount' => $request->discount,
            'total' => $request->total,
            'status' => 'pending',
            'created_at' => now(),
        ]);

        $carts = Cart::where('user_id', Auth::id())->get();
        foreach ($carts as $cart) {
            OrderDetail::create([
                'order_id' => $orderId,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'created_at' => now(),
            ]);
        }

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $request->name,
                'country' => $request->country,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'phone' => $request->phone,
                'created_at' => now(),
            ]
        );

        if (session('discount')) {
            $coupon = coupon::find(session('discount'));
            $coupon->status = 'Used';
            $coupon->save();

            session()->forget('discount');
            session()->forget('discountPrecentage');
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect('/paymentform/' . $orderId)->with('success', 'Order placed successfully!');
    }


    public function showpaymentform($id)
    {
        $order = Order::find($id);
        $payment = Payment::where('user_id', Auth::id())->first();
        return view('frontend.checkout.payment', compact('payment', 'order'));
    }


    public function checkoutForm()
    {
        $products = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('frontend.checkout.index', compact('products'));
    }

    public function savePayment(Request $request)
    {
        $request->validate([
            'card_name'   => 'required|string|max:255',
            'card_number' => 'required|numeric', // Removed digits limit
            'card_expiry' => 'required|string', // Updated regex delimiter
            'card_cvv'    => 'required|numeric', // Removed digits limit
        ]);

        // Save payment details
        Payment::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'card_name'   => $request->card_name,
                'card_number' => ($request->card_number),
                'card_expiry' => $request->card_expiry,
                'card_cvv'    => ($request->card_cvv),
                'created_at'  => now(),
            ]
        );



        return redirect('/order-recipt/' . $request->order_id)->with('success', 'Payment completed successfully!');
    }

    public function showorders()
    {
        $orders = Order::all();
        return view('backend.admin.order.index', compact('orders'));
    }
    public function showcancellations()
    {
        $orders = Order::where('status', 'Cancel Request')->get();
        return view('backend.admin.order.cancellations',  compact('orders'));
    }

    public function showorderdetails($id)
    {

        $order = Order::with(['orderdetails.product'])
            ->find($id);
        return view('backend.admin.order.view', compact('order'));
    }
    public function updateorderstatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function showOrderRecipt($id)
    {
        $order = Order::with(['orderdetails.product'])
            ->find($id);
        return view('frontend.checkout.recipt', compact('order'));
    }
}
