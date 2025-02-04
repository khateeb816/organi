@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body p-3 bg-light">
    <a href="{{ url('admin/orders') }}" class="btn btn-info mb-3">Back to Orders</a>
    <div class="table-responsive">
        <h2>Cancellations:</h2>
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
<!-- Include jQuery, Bootstrap 5 JS, and DataTables JS and CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
        });
    });
</script>
@include('backend.admin.components.footer')