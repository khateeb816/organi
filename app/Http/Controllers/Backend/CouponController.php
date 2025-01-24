<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Catagory;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
class CouponController extends Controller
{
    public function index()
    {
        $coupons = coupon::all();
        return view('backend.admin.coupon.index', compact('coupons'));
    }

    public function add()
    {
        return view('backend.admin.coupon.add');
    }

    public function save(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'required|date',
        ]);

        coupon::create($request->all());
        return redirect()->back()->with('success', 'Coupon created successfully.');
    }

    public function edit($id)
    {
        $coupon = coupon::findOrFail($id);
        return view('backend.admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|max:255|unique:coupons,code,' . $id,
            'percentage' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'required|date',
            'status' => 'required|boolean',
        ]);
        
        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());

        return redirect()->back()->with('success', 'Coupon updated successfully!');
    }



    public function delete($id)
    {
        coupon::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'coupon coupon deleted successfully.');
    }
}
