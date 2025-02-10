@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body p-3 bg-light">
    <div class="table-responsive">
        <h2>Orders:</h2>
        <br>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Orders Today</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $ordersToday }}</h2>
                            <p class="text-white mb-0">{{ \Carbon\Carbon::today()->format('M d, Y') }}</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Orders This Week</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $ordersThisWeek }}</h2>
                            <p class="text-white mb-0">{{ \Carbon\Carbon::now()->startOfWeek()->format('M d, Y') }} - {{
                                \Carbon\Carbon::now()->endOfWeek()->format('M d, Y') }}</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">Orders This Month</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $ordersThisMonth }}</h2>
                            <p class="text-white mb-0">{{ \Carbon\Carbon::now()->format('F Y') }}</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body">
                        <h3 class="card-title text-white">Orders This Year</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $ordersThisYear }}</h2>
                            <p class="text-white mb-0">{{ \Carbon\Carbon::now()->format('Y') }}</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                    </div>
                </div>
            </div>
        </div>

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