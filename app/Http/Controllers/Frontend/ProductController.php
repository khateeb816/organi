<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        $product = Product::with('catagory')->findOrFail($id);
        $relatedProducts = Product::where('catagory_id', $product->catagory_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        $reviewed = false;

        if (Review::where('user_id', Auth::id())->where('product_id', $id)->first()) {
            $reviewed = true;
        }
        $reviews = Review::where('product_id', $id)->with('user')->take(8)->get();

        return view('frontend.shop.shopDetails', compact('product', 'relatedProducts', 'reviewed', 'reviews'));
    }

    public function searchItem(Request $request)
    {
        return redirect('/shop?search=' . $request->search);
    }
}
