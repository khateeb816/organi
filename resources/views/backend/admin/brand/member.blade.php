@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<!-- Include Bootstrap 5 CSS -->

<div class="content-body p-3 bg-light">
    <h2 class="mb-4">Members of Brand: {{ $brand->name }}</h2> <!-- Add the brand name heading -->

    <a href="{{ url('admin/member-add/' . $id) }}" class="btn btn-info">Add Member</a>
    <table id="table" class="display w-100">
        <thead>
            <tr>
                <th>Sno.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joind at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->created_at }}</td>
                    <td>
                        <a href="{{ url('admin/member-edit/' . $member->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('admin/member-delete/' . $member->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?');">Delete</a>
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
