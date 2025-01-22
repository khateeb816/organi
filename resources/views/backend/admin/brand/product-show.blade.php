@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body p-3 bg-light">
    <h2 class="mb-4">Products of Brand: <a href="{{ url('admin/brand-view/' . $id) }}"
            style="text-decoration: underline;">{{ $brand->name }}</a></h2> <!-- Add the brand name heading -->

    <table id="table" class="display w-100">
        <thead>
            <tr>
                <th>Sno.</th>
                <th>Name</th>
                <th>created_at</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <select name="status" class="form-select"
                            onchange="window.location.href='{{ url('admin/brand-product-status/' . $product->id) }}/' + this.value;">
                            <option value="active" @if ($product->status == 'active') selected @endif>Active</option>
                            <option value="blocked" @if ($product->status == 'blocked') selected @endif>Blocked</option>
                            <option value="pending" @if ($product->status == 'pending') selected @endif>Pending</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ url('admin/brand-product-view/' . $product->id) }}"
                            class="btn btn-sm btn-primary">View</a>
                        <a href="{{ url('admin/brand-product-delete/' . $product->id) }}" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include jQuery, Bootstrap 5 JS, and DataTables JS and CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

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
