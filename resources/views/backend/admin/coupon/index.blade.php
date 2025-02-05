@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')


<div class="content-body p-3 bg-light">
    <h1>Discount Coupons</h1>
    <a href="{{ url('admin/coupon-add') }}" class="btn btn-primary">Add New Coupon</a>
    <table id="table" class="table w-100">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Percentage</th>
                <th>Expiry Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coupons as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->code }}</td>
                <td>{{ $coupon->percentage }}%</td>
                <td>{{ $coupon->expiry_date }}</td>
                <td>{{ $coupon->status}}</td>
                <td>
                    <a href="{{ url('admin/coupon-edit/' . $coupon->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ url('admin/coupon-delete/' . $coupon->id) }}" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this Coupon?');">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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