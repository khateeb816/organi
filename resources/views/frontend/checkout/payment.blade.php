@include('frontend.components.header')
<meta http-equiv="Content-Security-Policy"
    content="script-src 'self' https://js.stripe.com https://m.stripe.network 'unsafe-inline' 'sha256-/5Guo2nzv5n/w6ukZpOBZOtTJBJPSkJ6mhHpnBgm3Ls=';">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<section class="checkout spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="checkout__form p-4 shadow rounded bg-light">
                    <h4 class="text-center mb-4">Enter Payment Details</h4>

                    @if(session('success'))
                    <p class="text-success">{{ session('success') }}</p>
                    @endif
                    @if(session('error'))
                    <p class="text-danger">{{ session('error') }}</p>
                    @endif

                    <form id="payment-form" class="require-validation"
                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" action="{{ url('/savepayment') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $order->total }}">
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <div class="form-group">
                            <label for="card_name">Cardholder Name</label>
                            <input type="text" name="card_name" id="card_name" class="form-control"
                                placeholder="John Doe" required>
                        </div>

                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input type="text" id="card_number" name='card_number' class="form-control card-number"
                                inputmode="numeric" maxlength="19" placeholder="1234 5678 9012 3456" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="card_expiry">Expiry Date</label>
                                <input type="text" id="card_expiry" class="form-control card-expiry-month"
                                    inputmode="numeric" name="card_exp" maxlength="5" placeholder="MM/YY" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="card_cvv">CVV</label>
                                <input type="text" name="card_cvv" id="card_cvv" class="form-control card-cvc"
                                    inputmode="numeric" maxlength="4" placeholder="123" required>
                            </div>
                        </div>

                        <button type="submit" class="primary-btn btn-block">Confirm Order</button>
                    </form>

                    <div id="card-errors" class="text-danger mt-2"></div>

                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.components.footer')
<script src="https://js.stripe.com/v2/"></script>
<script>
    $(document).ready(function () {
        var $form = $(".require-validation");
    
        // Fetch the publishable key from the data attribute of the form
        var stripePublishableKey = 'pk_test_51NBfWfKPSaRDhVEdeB7lk1s9xe6YDsITgyO4EfpgrJESjgXGUO8EX5WPCzkS6KgzCWddcG6Ay4ejMqQB6dRIo0FI00v3rVBpAj';
        if (!stripePublishableKey) {
            alert("Stripe publishable key is not set.");
            return;
        }
    
        // Set the Stripe publishable key
        Stripe.setPublishableKey(stripePublishableKey);
    
        // Format card number input
        $('#card_number').on('input', function () {
            var value = $(this).val().replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            var formattedValue = value.replace(/(.{4})/g, '$1 ').trim();
            $(this).val(formattedValue);
        });
    
        // Format expiry date input
        $('#card_expiry').on('input', function () {
            var value = $(this).val().replace(/[^0-9]/g, '');
            if (value.length > 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            $(this).val(value);
        });
    
        // Limit CVV input to 3 or 4 digits
        $('#card_cvv').on('input', function () {
            var value = $(this).val().replace(/[^0-9]/g, '');
            if (value.length > 4) {
                value = value.slice(0, 4);
            }
            $(this).val(value);
        });
    
        $form.on("submit", function (e) {
            e.preventDefault(); // Prevent form submission before Stripe token is created
    
            // Create the token using the card details
            Stripe.createToken(
                {
                    number: $(".card-number").val().replace(/\s+/g, ''), // Remove spaces for token creation
                    cvc: $(".card-cvc").val(),
                    exp_month: $(".card-expiry-month").val().split("/")[0],
                    exp_year: $(".card-expiry-month").val().split("/")[1],
                },
                stripeResponseHandler
            );
        });
    
        function stripeResponseHandler(status, response) {
            if (response.error) {
                // Show error message if there's a problem
                $("#card-errors").text(response.error.message);
            } else {
                var token = response.id;
    
                // Add the token to the form as a hidden input
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
    
                // Submit the form with the token
                $form.get(0).submit();
            }
        }
    });
    
</script>