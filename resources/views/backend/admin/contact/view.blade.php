@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body p-3 bg-light">
    <div class="container mt-4">
        <a href="{{ url('admin/messages') }}" class="btn btn-secondary mb-3">Back to Messages</a>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Message Details - #{{ $message->id }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Message ID</th>
                        <td>{{ $message->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $message->name }}</td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{{ $message->subject }}</td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td>{{ nl2br(e($message->message)) }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $message->created_at->format('d M, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@include('backend.admin.components.footer')