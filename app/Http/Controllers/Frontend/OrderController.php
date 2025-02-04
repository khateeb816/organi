<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cancellation;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showorders()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderdetails.product')->get();
        return view('frontend.orders.index', compact('orders'));
    }
    public function cancelOrders(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required',
        ]);

        $order = Order::find($id);
        $order->status = 'Cancel Request';
        $order->save();

        Cancellation::insert([
            'order_id' => $id,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
        ]);

        return redirect()->back();
    }
}
