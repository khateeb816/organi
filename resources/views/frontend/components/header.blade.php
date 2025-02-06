<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Prime Trading</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontendAssets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontendAssets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontendAssets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontendAssets/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontendAssets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontendAssets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontendAssets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontendAssets/css/style.css') }}" type="text/css">
    <link rel="shortcut icon" href="frontendAssets/img/logo.png" type="image/x-icon">

</head>

<body>
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('/frontendAssets/img/logo.png') }}" alt="image"></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li>
                    <a href="{{ url('wishlist') }}">
                        <i class="fa fa-heart"></i>
                        @auth
                        <span>{{ \App\Models\Wishlist::where('user_id', Auth::id())->count() }}</span>
                        @endauth
                    </a>
                </li>
                <li>
                    <a href="/shopingCart">
                        <i class="fa fa-shopping-bag"></i>
                        @auth
                        <span>{{ \App\Models\Cart::where('user_id', Auth::id())->count() }}</span>
                        @endauth
                    </a>
                </li>
            </ul>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                @if (Auth::check())
                <img src="img/language.png" alt="">
                <div>{{ Auth::user()->name }}</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#"><i class="fa fa-user"></i>&nbsp; Profile</a></li>
                    <li><a href="{{ url('/orders') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                            </svg>&nbsp; My
                            Orders</a></li>
                    <li><a href="/logout"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                <path fill-rule="evenodd"
                                    d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                            </svg>&nbsp; Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>
                @else
                <a href="{{ url('login') }}" style="color: black;"><i class="fa fa-user"></i>
                    Login</a>
                @endif
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/shop') }}">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="{{ url('/checkout') }}">Check Out</a></li>
                        <li><a href="{{ url('/blogDetails') }}">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/blog') }}">Blog</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__language">
                                @if (Auth::check())
                                <img src="img/language.png" alt="">
                                <div>{{ Auth::user()->name }}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#"><i class="fa fa-user"></i>&nbsp; Profile</a></li>
                                    <li><a href="{{ url('orders') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-list-ul"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                            </svg>&nbsp; My
                                            Orders</a></li>
                                    <li><a href="/logout"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                            </svg>&nbsp; Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>

                                </ul>
                                @else
                                <a href="{{ url('login') }}" style="color: black;"><i class="fa fa-user"></i>
                                    Login</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo" >
                        <a href="{{ url('/') }}"><img src="{{ asset('frontendAssets/img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/shop') }}">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="{{ url('/checkout') }}">Check Out</a></li>
                                    <li><a href="{{ url('/blogDetails') }}">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/blog') }}">Blog</a></li>
                            <li><a href="{{ url('/contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="{{ url('wishlist') }}">
                                    <i class="fa fa-heart"></i>
                                    @auth
                                    <span>{{ \App\Models\Wishlist::where('user_id', Auth::id())->count() }}</span>
                                    @endauth
                                </a>
                            </li>
                            <li>
                                <a href="/shopingCart">
                                    <i class="fa fa-shopping-bag"></i>
                                    @auth
                                    <span>{{ \App\Models\Cart::where('user_id', Auth::id())->count() }}</span>
                                    @endauth
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>

    </header>
    <!-- Header Section End -->

    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ url('/search-item') }}" method="POST">
                                @csrf
                                <input type="text" placeholder="What do yo u need?" name='search'>
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>

                    @if (request()->is('/'))
                    <div class="hero__item set-bg" data-setbg="{{ asset('frontendAssets/img/banner/Banner-1.png') }}">
                        <div class="hero__text">
                            <h2>Shop Smart <br />Shop Fast</h2>
                            <p style="color: white">
                                Discover the best deals <br>
                                on top-quality products. <br>
                                Secure payments, Fast delivery
                            </p>
                            <a href="{{ url('/shop') }}" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
