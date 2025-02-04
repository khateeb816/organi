<!-- Header Section Begin -->
@include('frontend.components.header')
<!-- Header Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontendAssets/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form action="{{url('/saveOrder')}}" method="post" >
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Full Name<span>*</span></p>
                                    <input type="text" name="name">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <input type="text" name="country">
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address" class="checkout_input_add" name="address">
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text" name="city">
                        </div>
                        <div class="checkout__input">
                            <p>State<span>*</span></p>
                            <input type="text" name="state">
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input type="text" name="postcode">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="phone">
                                </div>
                            </div>
                        </div>
                        <input value="2" type="hidden" name="discount">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout_order_products">Products <span>Total</span></div>
                            @php
                                $subtotal=0;
                                $discount=0;
                            @endphp
                            <ul>
                                @foreach ($products as $product)
                                <li>{{$product->product->name}} : {{$product->quantity}}<span>${{$product->product->price}}</span></li>
                                @php
                                    $subtotal += $product->quantity * $product->product->price;
                                @endphp
                                @endforeach
                            </ul>
                            <div class="checkout_order_subtotal">Subtotal <span>${{$subtotal}}</span></div>
                            <div class="checkout_order_total">Total <span>${{$subtotal - $discount}}</span></div>
                            <input type="hidden" name="total" value="{{$subtotal - $discount}}">
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->


<!-- Checkout Section Begin -->

<!-- Checkout Section End -->

<!-- Footer Section Begin -->
@include('frontend.components.footer')
<!-- Footer Section End -->
