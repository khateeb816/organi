<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        $product = Product::with('catagory')->findOrFail($id);
        $relatedProducts = Product::where('catagory_id', $product->catagory_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.shop.shopDetails', compact('product', 'relatedProducts'));
    }

    public function searchItem(Request $request)
    {
        return redirect('/shop?search=' . $request->search);
    }
}
