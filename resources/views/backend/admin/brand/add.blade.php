@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title my-3">Add Brand</h4>
                        <div class="basic-form">
                            <form action="{{ url('admin/brand-save') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Brand Name -->
                                <div class="form-group">
                                    <label for="name">Brand Name</label>
                                    <input type="text" name="name" class="form-control input-default"
                                        placeholder="Enter Brand Name">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group mb-4">
                                    <label for="image">Brand Logo</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                        accept=".jpeg,.jpg,.png,.gif">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Physical Address</label>
                                    <input type="address" name="address" class="form-control input-default"
                                        placeholder="Enter Physical Address">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Contact Number -->
                                <div class="form-group">
                                    <label for="number">Contact Number</label>
                                    <input type="text" name="number" class="form-control input-default"
                                        placeholder="Enter Contact Number">
                                    @error('number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Charge Percentage -->
                                <div class="form-group">
                                    <label for="charge">Charge (%)</label>
                                    <input type="number" name="charge" class="form-control input-default"
                                        placeholder="Enter Charge in Percentage">
                                    @error('charge')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Website URL -->
                                <div class="form-group">
                                    <label for="website">Website (Optional)</label>
                                    <input type="text" name="website" class="form-control input-default"
                                        placeholder="Enter Website URL">
                                    @error('website')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control input-default"
                                        placeholder="Enter Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description (Optional)</label>
                                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter Brand Description"></textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Categories -->
                                <div class="form-group">
                                    <label for="categories">Select Categories:</label>
                                    <div class="form-check">
                                        @if (count($categories) > 0)

                                            @foreach ($categories as $category)
                                                <div class="form-check">
                                                    <input type="checkbox" name="categories[]" class="form-check-input"
                                                        value="{{ $category->id }}" id="category_{{ $category->id }}">
                                                    <label class="form-check-label"
                                                        for="category_{{ $category->id }}">{{ $category->name }}</label>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-check">
                                                <label class="form-check-label" for="category">No category
                                                    available</label>
                                            </div>

                                        @endif
                                    </div>
                                    @error('categories')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark mb-2">Add Brand</button>
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
