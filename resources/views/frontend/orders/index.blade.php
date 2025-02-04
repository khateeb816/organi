<!-- Header Section Begin -->
@include('frontend.components.header')
<!-- Header Section End -->

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
    integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    .avatar-lg {
        height: 5rem;
        width: 5rem;
    }

    .font-size-18 {
        font-size: 18px !important;
    }

    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    a {
        text-decoration: none !important;
    }

    .w-xl {
        min-width: 160px;
    }

    .card {
        margin-bottom: 24px;
        -webkit-box-shadow: 0 2px 3px #e4e8f0;
        box-shadow: 0 2px 3px #e4e8f0;
    }

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #eff0f2;
        border-radius: 1rem;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-xl-8">
            <div class="me-4">
                <h2 class="text-truncate">My Orders:</h2>
            </div>
            <br><br>

            @foreach ($orders as $order)
            <div class="card border shadow-none">
                <div class="card-body">
                    @foreach ($order->orderdetails as $item)
                    @php
                    $images = json_decode($item->product->images, true);
                    $firstImage = $images[0] ?? 'default.jpg';
                    @endphp
                    <div class="d-flex align-items-start border-bottom pb-3">
                        <div class="me-4" style="margin-right: 40px;">
                            <img src="{{ asset($firstImage) }}" class="avatar-lg rounded" alt="Product Image">
                        </div>
                        <div class="flex-grow-1 align-self-center overflow-hidden">
                            <div>
                                <h5 class="text-truncate font-size-18">
                                    <a href="#" class="text-dark">{{ $item->product->name }}</a>
                                </h5>
                                <p class="text-muted mb-2">Quantity: {{ $item->quantity }}</p>
                            </div>
                        </div>
                        <div class="flex-grow-1 align-self-center overflow-hidden">
                            <div>
                                <h5 class="text-truncate font-size-18"></h5>
                                <p class="text-muted mb-2">Price: {{ $item->product->price }} PKR</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-3">
                                <p class="text-muted mb-2">Total</p>
                                <h5>{{ $order->total }} PKR</h5>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mt-3">
                                <p class="text-muted mb-2">Status</p>
                                <h5>{{ $order->status }} </h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4">
                                <!-- Button to trigger the modal -->
                                <button type="button" class="btn btn-outline-danger" {{ $order->status == 'Cancel
                                    Request' ? 'disabled' : '' }} data-bs-toggle="modal"
                                    data-bs-target="#cancelOrderModal{{ $order->id }}">
                                    Cancel Order
                                </button>

                                <!-- Modal for entering the cancellation reason -->
                                <div class="modal fade" id="cancelOrderModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="cancelOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelOrderModalLabel{{ $order->id }}">
                                                    Cancel Order</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="cancelOrderForm{{ $order->id }}" method="POST"
                                                    action="{{ url('/cancel-order/' . $order->id) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="reason" class="form-label">Reason for
                                                            Cancellation</label>
                                                        <textarea id="reason" name="reason" class="form-control"
                                                            rows="3" required></textarea>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Submit
                                                            Cancellation</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- JavaScript for form validation -->
    <script>
        @foreach ($orders as $order)
        const cancelOrderForm{{ $order->id }} = document.getElementById('cancelOrderForm{{ $order->id }}');
        cancelOrderForm{{ $order->id }}.addEventListener('submit', function(event) {
            const reason = document.getElementById('reason').value;
            if (!reason) {
                alert('Please provide a reason for cancellation.');
                event.preventDefault();
            }
        });
        @endforeach
    </script>

    <!-- Bootstrap JS (for modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</div>

@include('frontend.components.footer')