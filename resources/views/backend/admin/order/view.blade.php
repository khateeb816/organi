@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body p-3 bg-light">
<div class="container mt-4">
    <a href="{{ url('admin/orders') }}" class="btn btn-secondary mb-3">Back to Orders</a>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Order Details - #{{ $order->id }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Order ID</th>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                </tr>
                <tr>
                    <th>Products</th>
                    <td>
                        @php
                            $subtotal = 0;
                        @endphp
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            @foreach ($order->orderdetails as $product)
                                <tr>
                                    <td>{{ $product->product->name }}</td>
                                    <td>{{ $product->product->price }} PKR</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>

                                @php
                                    $subtotal += $product->product->price * $product->quantity;
                                @endphp
                            @endforeach
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <form action="{{ url('/admin/order/updatestatus/' . $order->id) }}" method="POST">
                            @csrf
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ $order->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Dispatched" {{ $order->status == 'Dispatched' ? 'selected' : '' }}>Dispatched</option>
                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Cancel" {{ $order->status == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <tr>
                    <th>Subtotal</th>
                    <td>{{ $subtotal }} PKR</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>{{ number_format($order->total ?? 0, 2) }} PKR</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
@include('backend.admin.components.footer')
