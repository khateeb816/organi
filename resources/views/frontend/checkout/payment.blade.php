@include('frontend.components.header')

<section class="checkout spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="checkout__form p-4 shadow rounded bg-light">
                    <h4 class="text-center mb-4">Enter Payment Details</h4>
                    <form action="{{ url('/savepayment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <div class="form-group">
                            <label for="card_name">Cardholder Name</label>
                            <input type="text" name="card_name" class="form-control" placeholder="John Doe" required>
                        </div>

                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <div class="input-group">
                                <input type="text" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="card_expiry">Expiry Date</label>
                                <input type="text" name="card_expiry" class="form-control" placeholder="MM/YY" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="card_cvv">CVV</label>
                                <input type="text" name="card_cvv" class="form-control" placeholder="123" required>
                            </div>
                        </div>
                        <button type="submit" class="primary-btn btn-block">Confirm Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.components.footer')

