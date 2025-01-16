@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title my-3">Edit catagory</h4>
                        <div class="basic-form">
                            <form action="{{ url('admin/catagory-update', $catagory->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control input-default" placeholder="Enter catagory Name" value="{{ old('name', $catagory->name) }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="description" class="form-control input-default" placeholder="Enter Discription" value="{{ old('description', $catagory->description) }}" required>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark mb-2">Update catagory</button>
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
