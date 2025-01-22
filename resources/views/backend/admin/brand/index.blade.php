@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<!-- Include Bootstrap 5 CSS -->

<div class="content-body p-3 bg-light">
    <a href="{{ url('admin/brand-add') }}" class="btn btn-info">Add Brand</a>
    <table id="table" class="display w-100">
        <thead>
            <tr>
                <th>Sno.</th>
                <th>Name</th>
                <th>Logo</th>
                <th>Email</th>
                <th>Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <img src="{{ asset($brand->logo) }}" alt="" width="50" height="50">
                    </td>
                    <td>{{ $brand->email }}</td>
                    <td>{{ $brand->number }}</td>
                    <td>
                        <a href="{{ url('admin/brand-view/' . $brand->id) }}" class="btn btn-primary">View</a>
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
            // Optional: Add any DataTable options here
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
        });
    });
</script>

@include('backend.admin.components.footer')
