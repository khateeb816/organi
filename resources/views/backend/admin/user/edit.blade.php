@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title my-3">Edit user</h4>
                        <div class="basic-form">
                            <form action="{{ url('admin/user-update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control input-default" placeholder="Enter user Name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control input-default" placeholder="Enter Physical Address" value="{{ old('email', $user->email) }}" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                               
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark mb-2">Update user</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.admin.components.footer')
