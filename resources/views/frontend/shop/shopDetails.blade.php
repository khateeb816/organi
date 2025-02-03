<!-- Header Section Begin -->
@include('frontend.components.header')
<!-- Header Section End -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontendAssets/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Vegetable’s Package</h2>
                    <div class="breadcrumb__option">
                        <span>Vegetable’s Package</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->





<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        @php
                            $images = (array) json_decode($product->images);
                            $firstImage = $images[0] ?? 'default.jpg';
                        @endphp
                        <img class="product__details__pic__item--large" src="{{ asset($firstImage) }}"
                            alt="{{ $product->name }}">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @foreach ($images as $image)
                            <img data-imgbigurl="{{ asset($image) }}" src="{{ asset($image) }}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->name }}</h3>
                    <div class="product__details__rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa {{ $i <= round($product->rating) ? 'fa-star' : 'fa-star-o' }}"></i>
                        @endfor
                        <span>({{ $product->reviews_count }} reviews)</span>
                    </div>
                    <div class="product__details__price">${{ number_format($product->price, 2) }}</div>
                    <p>{{ $product->description }}</p>
                    <form action="{{ url('add-to-cart-quanitity') }}" method="post">
                        @csrf
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <input type="text" value="1" name="quantity">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="primary-btn border-0">ADD TO CART</button>
                    </form>
                    @if (auth()->check() &&
                            \App\Models\Wishlist::where('user_id', auth()->user()->id)->where('product_id', $product->id)->exists())
                        <a href="{{ url('remove-from-wishlist/' . $product->id) }}" class="heart-icon">
                            <i class="fa-solid fa-heart text-danger"></i>
                        </a>
                    @else
                        <a href="{{ url('add-to-wishlist/' . $product->id) }}" class="heart-icon">
                            <span class="icon_heart_alt"></span>
                        </a>
                    @endif

                    <ul>
                        <li><b>Availability</b>
                            <span>{{ $product->total_items > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                        </li>

                        <li><b>Size</b>
                            @php
                                $sizes = json_decode($product->size, true) ?? [];
                            @endphp
                            <span>{{ implode(', ', $sizes) }}</span>
                        </li>

                        <li><b>Color</b>
                            @php
                                $colors = json_decode($product->color, true) ?? [];
                            @endphp
                            <span>
                                @foreach ($colors as $color)
                                    <span
                                        style="display: inline-block; width: 20px; height: 20px; background-color: {{ $color }}; border: 1px solid #000; margin-right: 5px;"></span>
                                @endforeach
                            </span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Details Section End -->


<!-- Product Review and Rating Section Begin -->

<section class="product-review">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Customer Reviews</h3>
                @if (!$reviewed)
                    <form action="{{ url('save-review') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <!-- Replace with dynamic value -->

                        <!-- Star Rating Input -->
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <div class="star-rating">
                                <span class="fa fa-star" data-value="1"></span>
                                <span class="fa fa-star" data-value="2"></span>
                                <span class="fa fa-star" data-value="3"></span>
                                <span class="fa fa-star" data-value="4"></span>
                                <span class="fa fa-star" data-value="5"></span>
                            </div>
                            <input type="hidden" name="rating" id="ratingValue" value="0">
                        </div>

                        <!-- Review Text -->
                        <div class="form-group">
                            <label for="review">Your Review:</label>
                            <textarea name="review" class="form-control" rows="4" ></textarea>
                        </div>

                        <button type="submit" class="primary-btn">Submit Review</button>
                    </form>
                @endif
                @foreach ($reviews as $review)
                <div class="col-lg-12 border bg-light bg-gradient p-3 my-2">
                    <div class="d-flex align-items-center">
                        <h4>{{ $review->user->name }}</h4>&nbsp;

                        <!-- Star Rating Display -->
                        <div class="rating-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star {{ $i <= $review->rating ? 'checked' : '' }}"></i>
                            @endfor
                        </div>
                    </div>

                    <p class="col-lg-12 border bg-light bg-gradient"
                    style="padding-left: 30px; padding-top: 5px; padding-bottom: 5px;">
                     {{ $review->review }}
                 </p>


                </div>
            @endforeach



            </div>
        </div>
    </div>
</section>
<!-- Product Review and Rating Section End -->




<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($relatedProducts as $related)
                @php
                    $relatedImages = json_decode($related->images);
                    $relatedFirstImage = $relatedImages[0] ?? 'default.jpg';
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset($relatedFirstImage) }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="{{ url('add-to-wishlist', $related->id) }}"><i
                                            class="fa fa-heart"></i></a>
                                </li>
                                <li><a href="{{ url('product-details', $related->id) }}"><i
                                            class="fa fa-retweet"></i></a>
                                </li>
                                <li><a href="{{ url('add-to-cart', $related->id) }}"><i
                                            class="fa fa-shopping-cart"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ url('product-details', $related->id) }}">{{ $related->name }}</a></h6>
                            <h5>${{ $related->price }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Related Product Section End -->
{{-- Custom Script  --}}
<script>
    const stars = document.querySelectorAll('.star-rating .fa');
    const ratingInput = document.getElementById('ratingValue');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            let rating = this.getAttribute('data-value');
            ratingInput.value = rating;

            // Reset all stars
            stars.forEach(s => s.classList.remove('checked'));

            // Highlight selected stars
            for (let i = 0; i < rating; i++) {
                stars[i].classList.add('checked');
            }
        });
    });
</script>


<!-- Footer Section Begin -->
@include('frontend.components.footer ');
<!-- Footer Section End -->
