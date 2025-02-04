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
                            <a href="{{ url('admin/message-reply/' . $message->id) }}" class="btn btn-primary btn-sm">Reply</a>                            <a href="{{ url('admin/message-delete/' . $message->id) }}" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@include('backend.admin.components.footer')
