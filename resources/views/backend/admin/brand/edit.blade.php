@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title my-3">Edit Brand</h4>
                        <div class="basic-form">
                            <form action="{{ url('admin/brand-update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control input-default" placeholder="Enter Brand Name" value="{{ old('name', $brand->name) }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="file" name="image" class="form-control" id="image" accept=".jpeg,.jpg,.png,.gif">
                                    <label for="image" class="form-label">Current Image:</label>
                                    @if ($brand->logo)
                                        <img src="{{ asset($brand->logo) }}" alt="Current Image" width="100" height="100" class="mb-2">
                                    @endif
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control input-default" placeholder="Enter Physical Address" value="{{ old('address', $brand->address) }}" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="number" class="form-control input-default" placeholder="Enter Contact Number" value="{{ old('number', $brand->number) }}" required>
                                    @error('number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark mb-2">Update Brand</button>
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
