<?php

namespace App\Http\Controllers\Backend;

use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Profile;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function saveOrderDetails(Request $request)
    {
        $request->validate([
            'discount'  => 'nullable',
            'total'     => 'required|numeric',
            'name'      => 'required|string',
            'country'   => 'required|string',
            'address'   => 'required|string',
            'city'      => 'required|string',
            'state'     => 'required|string',
            'postcode'  => 'required|string',
            'phone'     => 'required|string',
        ]);

        // Create a new order
        $orderId = Order::insertGetId([
            'user_id' => Auth::id(),
            'discount' => $request->discount ?? 0,
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

        // Update user profile with order details
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
                'updated_at' => now(),
            ]
        );

        // Handle coupon if applied
        if (session()->has('discount')) {
            $coupon = Coupon::find(session('discount'));
            if ($coupon) {
                $coupon->status = 'Used';
                $coupon->save();
            }

            session()->forget(['discount', 'discountPercentage']);
        }

        // Clear user's cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect('/paymentform/' . $orderId)->with('success', 'Order placed successfully! Pay Now');
    }

    public function showPaymentForm($id)
    {
        $order = Order::findOrFail($id);
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
        // Validate the incoming request
        $request->validate([
            'amount' => 'required|numeric',
            'order_id' => 'required|integer',
            'stripeToken' => 'required|string',
            'card_name' => 'required|string',
        ]);

        // Set your Stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a charge using the Stripe token
            $charge = Charge::create([
                'amount' => (int)(($request->amount * 280) * 100), // Amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken, // Use the token from the request
                'description' => 'Order Payment for Order ID: ' . $request->order_id,
            ]);

            if ($charge->status === 'succeeded') {
                // Save only necessary payment details

                $order = Order::find($request->order_id);
                if ($order) {
                    $order->payment_status = 'paid';
                    $order->save();
                }
                Payment::updateOrCreate(
                    ['user_id' => Auth::id()],
                    [
                        'card_name' => $request->card_name,
                        'card_number' => str_replace(' ', '', $request->card_number), // Remove all spaces
                        'card_expiry' => $request->card_exp,
                        'card_cvv' => $request->card_cvv,
                        'created_at' => now(),
                    ]
                );

                return redirect('/order-receipt/' . $request->order_id)->with('success', 'Payment completed successfully!');
            }

            return back()->with('error', 'Payment failed. Please try again.');
        } catch (\Stripe\Exception\CardException $e) {
            // Handle card errors
            return back()->with('error', 'Payment error: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other errors
            return back()->with('error', 'Payment error: ' . $e->getMessage());
        }
    }

    public function showOrders()
    {
        $orders = Order::all();
        return view('backend.admin.order.index', compact('orders'));
    }

    public function showCancellations()
    {
        $orders = Order::where('status', 'Cancel Request')->get();
        return view('backend.admin.order.cancellations', compact('orders'));
    }

    public function showOrderDetails($id)
    {
        $order = Order::with(['orderdetails.product'])->findOrFail($id);

        $order->read = 1;
        $order->save();
        return view('backend.admin.order.view', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function showOrderReceipt($id)
    {
        $order = Order::with(['orderdetails.product'])->findOrFail($id);
        return view('frontend.checkout.recipt', compact('order'));
    }
}
