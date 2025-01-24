@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')


<div class="content-body p-3 bg-light">
<h1>Discount Coupons</h1>
<a href="{{ url('admin/coupon-add') }}" class="btn btn-primary">Add New Coupon</a>
<table class="table">
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
            <td>{{ $coupon->status ? 'Active' : 'Inactive' }}</td>
            <td>
                <a href="{{ url('admin/coupon-edit/' . $coupon->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ url('admin/coupon-delete/' . $coupon->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Coupon?');">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@include('backend.admin.components.footer')

