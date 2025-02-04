<!-- Header Section Begin -->
@include('frontend.components.header')
<!-- Header Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontendAssets/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi Shop</h2>
                    <div class="breadcrumb__option">
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            @foreach ($categories as $category)
                            <li><a href="{{ url('/shop?category=' . $category->id) }}">{{ $category->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="range-slider">
                                <label for="minPrice">Min Price:</label>
                                <input type="range" id="minPriceSlider" min="10" max="9999" value="10">
                                <span id="minPriceValue">$10</span>

                                <label for="maxPrice">Max Price:</label>
                                <input type="range" id="maxPriceSlider" min="10" max="9999" value="9999">
                                <span id="maxPriceValue">$9999</span>
                            </div>
                        </div>

                        <form method="GET" action="{{ url('/shop') }}">
                            <input type="hidden" name="minPrice" id="minPrice" value="10">
                            <input type="hidden" name="maxPrice" id="maxPrice" value="9999">
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                        </form>
                    </div>

                    <script>
                        // Get references to the elements
                        const minPriceSlider = document.getElementById("minPriceSlider");
                        const maxPriceSlider = document.getElementById("maxPriceSlider");
                        const minPriceValue = document.getElementById("minPriceValue");
                        const maxPriceValue = document.getElementById("maxPriceValue");
                        const minPriceInput = document.getElementById("minPrice");
                        const maxPriceInput = document.getElementById("maxPrice");

                        // Update values when sliders change
                        minPriceSlider.addEventListener("input", function() {
                            let minValue = parseInt(minPriceSlider.value);
                            let maxValue = parseInt(maxPriceSlider.value);

                            if (minValue >= maxValue) {
                                minPriceSlider.value = maxValue - 10; // Ensure min is always less than max
                            }

                            minPriceValue.textContent = `$${minPriceSlider.value}`;
                            minPriceInput.value = minPriceSlider.value;
                        });

                        maxPriceSlider.addEventListener("input", function() {
                            let minValue = parseInt(minPriceSlider.value);
                            let maxValue = parseInt(maxPriceSlider.value);

                            if (maxValue <= minValue) {
                                maxPriceSlider.value = minValue + 10; // Ensure max is always greater than min
                            }

                            maxPriceValue.textContent = `$${maxPriceSlider.value}`;
                            maxPriceInput.value = maxPriceSlider.value;
                        });
                    </script>


                    <div class="sidebar__item sidebar__item__color--option">
                        <h4>Colors</h4>
                        @foreach (['white', 'gray', 'red', 'black', 'blue', 'green'] as $color)
                        <div class="sidebar__item__color sidebar__item__color--{{ $color }}">
                            <a href="{{ url('/shop?color=' . $color) }}">
                                <label for="{{ $color }}">
                                    {{ ucfirst($color) }}
                                    <div id="{{ $color }}"></div>
                                </label>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <div class="sidebar__item">
                        <h4>Popular Size</h4>
                        @foreach ([ 'XL' , 'L', 'M', 'S', 'XS'] as $size)
                        <div class="sidebar__item__size">
                            <a href="{{ url('/shop?size=' . $size) }}">
                                <label for="{{ $size }}">
                                    {{ ucfirst($size) }}
                                </label>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <div class="sidebar__item">
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
                </div>
            </div>

            <div class="col-lg-9 col-md-7">
                <div class="row">
                    @foreach ($products as $product)
                    @php
                    $images = (array) json_decode($product->images);
                    $firstImage = $images[0];
                    @endphp
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset($firstImage) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="{{ url('add-to-wishlist/' . $product->id) }}"><i
                                                class="fa fa-heart"></i></a></li>
                                    <li><a href="{{ url('/product-details/' . $product->id) }}"><i
                                                class="fa fa-retweet"></i></a></li>
                                    <li><a href="{{ url('/add-to-cart/' . $product->id) . '/1'}}"><i
                                                class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $product->name }}</a></h6>
                                <h5>${{ $product->price }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="product__pagination">
                    <!-- Laravel Pagination Links -->
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Footer Section Begin -->
@include('frontend.components.footer')
<!-- Footer Section End -->
