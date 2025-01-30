<!-- Header Section Begin -->
@include('frontend.components.header')
<!-- Header Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontendAssets/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>My Wishlist</h2>
                    <div class="breadcrumb__option">
                        <span>Wishlist</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Wishlist Section Begin -->
<section class="wishlist spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="wishlist__table">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th class="wishlist__product">Product</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlistItems as $wishlist)
                            @php
                            $images = (array) json_decode($wishlist->product->images);
                            $firstImage = $images[0] ?? 'default.jpg';
                            @endphp
                            <tr>
                                <td class="wishlist__item">
                                    <img src="{{ asset($firstImage) }}" width="100">
                                </td>
                                <td class="wishlist__item">
                                    <h5>{{ $wishlist->product->name }}</h5>
                                </td>
                                <td class="wishlist__price">
                                    ${{ number_format($wishlist->product->price, 2) }}
                                </td>
                                <td class="wishlist__actions">
                                    <a href="{{ url('/move-to-cart', $wishlist->id) }}" class="btn primary-btn">Move
                                        to
                                        Cart</a>
                                    <a href="{{ url('/remove-wishlist-item', $wishlist->id) }}"
                                        class="btn primary-btn">Remove</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Wishlist Section End -->

<!-- Footer Section Begin -->
@include('frontend.components.footer')
<!-- Footer Section End -->