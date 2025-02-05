@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body p-3 bg-light">
    <div class="table-responsive">
        <table id="table" class="display table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>user_id</th>
                    <th>User Name</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $key => $message)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $message->user_id ?? 'Guest' }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ Str::limit($message->message, 50) }}</td>
                    <td>
                        <a href="{{ url('admin/message-reply/' . $message->id) }}"
                            class="btn btn-primary btn-sm">Reply</a> <a
                            href="{{ url('admin/message-delete/' . $message->id) }}" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                    </td>
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