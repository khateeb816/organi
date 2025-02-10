<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Catagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if (Auth::user()->role == 'admin') {

                return redirect('admin/dash');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function showDashboard()
    {
        $today = Carbon::today();
        $orders = Order::whereDate('created_at', $today)->get();

        $ordersByHour = $orders->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->hour;
        });

        $data = [];
        foreach (range(0, 23) as $hour) {
            $data[] = [
                'label' => $hour . ':00',
                'y' => isset($ordersByHour[$hour]) ? $ordersByHour[$hour]->count() : 0
            ];
        }

        $brands = Brand::withCount('products')->get();
        $categories = Catagory::withCount('products')->get();
        return view('backend.admin.dashboard.index', compact('categories', 'brands', 'data'));
    }
}
