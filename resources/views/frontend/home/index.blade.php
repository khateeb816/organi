@include('frontend.components.header');


<!-- Brands Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($brands as $brand)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset($brand->logo) }}">
                            <h5><a href="#">{{ $brand->name }}</a></h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Categories Section End -->



<!-- Featured Section Begin -->

<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach ($featured as $item)
                @php
                    $images = (array) json_decode($item->images);
                    $firstImage = $images[0];
                @endphp

                <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset($firstImage) }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li>
                                    <a href="{{ url('/add-to-cart/' . $item->id . '/1') }}">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="{{ url('product-details/' . $item->id) }}">{{ $item->name }}</a></h6>
                            <h5>${{ $item->price }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Section End -->



<!-- Banner Begin -->

<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('frontendAssets/img/banner/banner-1.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('frontendAssets/img/banner/banner-2.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Banner End -->



<!-- Latest Product Section Begin -->


<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @php
                                $latest_first = $latest->slice(0, 3); // First 3 items
                                $latest_second = $latest->slice(3, 3); // Last 3 items
                            @endphp
                            @foreach ($latest_first as $item)
                                @php
                                    $images = (array) json_decode($item->images);
                                    $firstImage = $images[0];
                                @endphp
                                <a href="{{ url('product-details/' . $item->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($firstImage) }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $item->name }}</h6>
                                        <span>${{ $item->price }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @foreach ($latest_second as $item)
                                @php
                                    $images = (array) json_decode($item->images);
                                    $firstImage = $images[0];
                                @endphp
                                <a href="{{ url('product-details/' . $item->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($firstImage) }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $item->name }}</h6>
                                        <span>${{ $item->price }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @php
                                $top_first = $top_rated->slice(0, 3); // First 3 items
                                $top_second = $top_rated->slice(3, 3); // Last 3 items
                            @endphp
                            @foreach ($top_first as $item)
                                @php
                                    $images = (array) json_decode($item->images);
                                    $firstImage = $images[0];
                                @endphp
                                <a href="{{ url('product-details/' . $item->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($firstImage) }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $item->name }}</h6>
                                        <span>${{ $item->price }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @foreach ($top_second as $item)
                                @php
                                    $images = (array) json_decode($item->images);
                                    $firstImage = $images[0];
                                @endphp
                                <a href="{{ url('product-details/' . $item->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($firstImage) }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $item->name }}</h6>
                                        <span>${{ $item->price }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @php
                                $review_first = $reviews->slice(0, 3); // First 3 items
                                $review_second = $reviews->slice(3, 3); // Last 3 items
                            @endphp
                            @foreach ($review_first as $item)
                                @php
                                    $images = (array) json_decode($item->images);
                                    $firstImage = $images[0];
                                @endphp

                                <a href="{{ url('product-details/' . $item->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($firstImage) }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $item->name }}</h6>
                                        <span>${{ $item->price }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @foreach ($review_second as $item)
                                @php
                                    $images = (array) json_decode($item->images);
                                    $firstImage = $images[0];
                                @endphp

                                <a href="{{ url('product-details/' . $item->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($firstImage) }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $item->name }}</h6>
                                        <span>${{ $item->price }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Product Section End -->



<!-- Blog Section Begin -->

<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset('frontendAssets/img/blog/blog-1.jpg') }}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset('frontendAssets/img/blog/blog-2.jpg') }}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset('frontendAssets/img/blog/blog-3.jpg') }}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Visit the clean farm in the US</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section End -->



<!-- Footer Section Begin -->
@include('frontend.components.footer ');
<!-- Footer Section End -->
