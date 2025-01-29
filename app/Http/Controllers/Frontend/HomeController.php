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

    $top_rated = Product::where('state','top_rated')
        ->where('status', 'active')
        ->take(6)
        ->get();


        $reviews = Product::where('state','review')
            ->where('status', 'active')
            ->take(6)
            ->get();

        return view('frontend.home.index', compact( 'brands', 'featured', 'top_rated', 'latest' , 'reviews'));
    }


    public function shopGrid(){
        return view('frontend.shop.index');
    }

    public function shopDetails(){
        return view('frontend.shop.shopDetails');
    }


    public function checkout(){
        return view('frontend.checkout.index');
    }


    public function blogDetails(){
        return view('frontend.blogs.blogDetails');
    }


    public function blog(){
        return view('frontend.blogs.index');
    }


    public function contact(){
        return view('frontend.contact.index');
    }



}
