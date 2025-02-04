@include('frontend.components.header')

<section class="gradient-custom" style="margin-top: -30px;">
    <div class="container pb-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-header px-4 py-5">
                        <h5 class="text-muted mb-0">Thanks for your Order.</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
                        </div>

                        @php
                        $subtotal = 0;
                        @endphp

                        @foreach ($order->orderdetails as $item)
                        @php
                        $images = json_decode($item->product->images, true); // Decode JSON
                        $firstImage = $images[0] ?? 'default.jpg'; // Get first image or default
                        $itemTotal = $item->product->price * $item->quantity; // Total per item
                        $subtotal += $itemTotal;
                        @endphp

                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ asset($firstImage) }}" class="img-fluid" alt="Product Image">
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0">{{ $item->product->name }}</p>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">Qty: {{ $item->quantity }}</p>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">{{ number_format($itemTotal) }} PKR</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Order Summary -->
                        <div class="d-flex justify-content-between pt-2">
                            <p class="fw-bold mb-0">Order Details</p>
                            <p class="text-muted mb-0"><span class="fw-bold me-4">Subtotal</span> {{
                                number_format($subtotal) }} PKR</p>
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <p class="text-muted mb-0">Invoice Number: #{{ $order->id }}</p>
                            <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> {{ $order->discount
                                }}%</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">Invoice Date: {{ $order->created_at->format('d M Y') }}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
                        </div>

                        @php
                        $discountAmount = ($subtotal * $order->discount) / 100;
                        $totalAfterDiscount = $subtotal - $discountAmount;
                        @endphp

                        <div class="d-flex justify-content-between pt-2">
                            <p class="text-muted mb-0"><span class="fw-bold me-4">Total After Discount</span> {{
                                number_format($totalAfterDiscount) }} PKR</p>
                        </div>
                    </div>

                    <div class="card-footer border-0 px-4 py-5"
                        style="background-color: #7fad39; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                            Total Paid: <span class="h2 mb-0 ms-2">{{ number_format($order->total) }} PKR</span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.components.footer')