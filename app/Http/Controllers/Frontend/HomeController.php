<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home(){
        return view('frontend.home.index');
    }

    public function shopGrid(){
        return view('frontend.shop.index');
    }

    public function shopDetails(){
        return view('frontend.shop.shopDetails');
    }

    public function shopingCart(){
        return view('frontend.shop.shopingCart');
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
