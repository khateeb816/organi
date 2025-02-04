<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home()
    {
        $brands = Brand::all();
        $featured = Product::where('state', 'featured')
            ->where('status', 'active')
            ->take(8)
            ->get();

        $latest = Product::where('state', 'latest')
            ->where('status', 'active')
            ->take(6)
            ->get();

        $top_rated = Product::where('state', 'top_rated')
            ->where('status', 'active')
            ->take(6)
            ->get();


        $reviews = Product::where('state', 'review')
            ->where('status', 'active')
            ->take(6)
            ->get();

        return view('frontend.home.index', compact('brands', 'featured', 'top_rated', 'latest', 'reviews'));
    }


    public function shopGrid(Request $request)
    {
        $categoryId = $request->query('category');
        $minPrice = $request->query('minPrice');
        $maxPrice = $request->query('maxPrice');

        $query = Product::where('status', 'active');

        if ($categoryId) {
            $query->where('catagory_id', $categoryId);
        }

        if ($minPrice && $maxPrice) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }


        $categories = Catagory::all();

        $latest = Product::where('state', 'latest')
            ->where('status', 'active')
            ->take(6)
            ->get();

        if ($request->color) {
            $products = Product::whereJsonContains('color', $request->color)->paginate(10);

            return view('frontend.shop.index', compact('categories', 'latest', 'products'));
        }

        if ($request->size) {
            $products = Product::whereJsonContains('size', $request->size)->paginate(10);

            return view('frontend.shop.index', compact('categories', 'latest', 'products'));
        }

        if ($request->search) {
            $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->paginate(10);

            return view('frontend.shop.index', compact('categories', 'latest', 'products'));
        }

        $products = $query->paginate(10);
        return view('frontend.shop.index', compact('categories', 'latest', 'products'));
    }


    public function shopDetails()
    {
        return view('frontend.shop.shopDetails');
    }


    public function checkout()
    {
        return view('frontend.checkout.index');
    }


    public function blogDetails()
    {
        return view('frontend.blogs.blogDetails');
    }


    public function blog()
    {
        return view('frontend.blogs.index');
    }


    public function contact()
    {
        return view('frontend.contact.index');
    }
}
