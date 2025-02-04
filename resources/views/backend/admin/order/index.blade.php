@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body p-3 bg-light">
    <a href="{{ url('admin/orders') }}" class="btn btn-info mb-3">Back to Orders</a>
    <div class="table-responsive">
        <table id="table" class="display table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>{{ $order->total }} PKR</td>
                        <td>{{ $order->status }}</td>
                        <td><a href="{{url('admin/order-detail/'. $order->id)}}" class="btn btn-info">View</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@include('backend.admin.components.footer')
