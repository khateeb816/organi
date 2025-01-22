@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<style>
    .profile-sidebar {
        background: linear-gradient(135deg, #4158D0 0%, #C850C0 100%);
    }

    .nav-pills .nav-link {
        color: #6c757d;
        border-radius: 10px;
        padding: 12px 20px;
        margin: 4px 0;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
    }

    .nav-pills .nav-link.active {
        background-color: #fff;
        color: #4158D0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .profile-header {
        background: linear-gradient(135deg, #4158D0 0%, #C850C0 100%);
        height: 150px;
        border-radius: 15px;
    }

    .profile-pic {
        width: 120px;
        height: 120px;
        border: 4px solid #fff;
        margin-top: -60px;
        background-color: #fff;
    }

    .settings-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .settings-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="profile-header position-relative mb-4"></div>
                <div class="text-center">
                    <div class="position-relative d-inline-block">
                        <img src="{{ asset($brand->logo) }}" class="rounded-circle profile-pic" alt="Brand Logo">
                        <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle"
                            data-bs-toggle="modal" data-bs-target="#uploadImageModal">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    <h3 class="mt-3 mb-1">{{ $brand->name }}</h3>
                </div>
            </div>

            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-3 border-end">
                                <div class="p-4">
                                    <div class="nav flex-column nav-pills">
                                        <a class="nav-link active" href="#"><i
                                                class="fas fa-user me-2"></i>Personal Info</a>
                                        <a class="nav-link" href="{{ url('admin/brand-product/' . $brand->id) }}"><i
                                                class="fa-solid fa-bag-shopping me-2"></i>Products</a>
                                        <a class="nav-link" href="{{ url('admin/brand-member/' . $brand->id) }}"><i
                                                class="fa-solid fa-people-arrows me-2"></i>Members</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="p-4" id="content">
                                    <div class="row mb-3">
                                        <button id="editBrandBtn" class="btn btn-light col-6"><i
                                                class="fas fa-edit me-2"></i>Edit Brand</button>
                                        <a href="{{ url('admin/brand-delete/' . $brand->id) }}"
                                            class="btn btn-outline-danger col-6" id="deleteBrandBtn">
                                            <i class="fa-solid fa-trash me-2"></i>Delete Brand
                                        </a>
                                    </div>
                                    <form id="brandForm" class="m-4"
                                        action="{{ url('admin/brand-update/' . $brand->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <h5 class="col-6 mb-4">Brand Information</h5>

                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="name" class="form-label">Name</label>
                                                <input name="name" type="text" class="form-control" id="name"
                                                    value="{{ $brand->name }}" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input name="email" type="email" class="form-control" id="email"
                                                    value="{{ $brand->email }}" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="number" class="form-label">Phone</label>
                                                <input name="number" type="tel" class="form-control" id="number"
                                                    value="{{ $brand->number }}" disabled>
                                            </div>
                                            <div class="col-12">
                                                <label for="description" class="form-label">Bio</label>
                                                <textarea name="description" class="form-control" id="description" rows="4" disabled>{{ $brand->description }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label for="address" class="form-label">Physical Address</label>
                                                <textarea name="address" class="form-control" id="address" rows="4" disabled>{{ $brand->address }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" class="form-select" id="status" disabled>
                                                    <option value="Active" @if ($brand->status === 'Active') selected @endif>Active</option>
                                                    <option value="Pending" @if ($brand->status === 'Pending') selected @endif>Pending</option>
                                                    <option value="Blocked" @if ($brand->status === 'Blocked') selected @endif>Blocked</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="categories" class="form-label">Select Categories:</label>
                                                <div class="form-check">
                                                    @if ($categories->isNotEmpty())
                                                        @php
                                                            $allowed_categories = json_decode($brand->allowed_categories, true) ?? [];
                                                        @endphp
                                                        @foreach ($categories as $category)
                                                            @if ($category !== null)
                                                                <div class="form-check">
                                                                    <input type="checkbox" name="categories[]"
                                                                        class="form-check-input categories"
                                                                        value="{{ $category->id }}"
                                                                        id="category_{{ $category->id }}"
                                                                        {{ in_array($category->id, $allowed_categories) ? 'checked' : '' }} disabled>
                                                                    <label class="form-check-label"
                                                                        for="category_{{ $category->id }}">{{ $category->name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <div class="text-muted">No categories available</div>
                                                    @endif
                                                </div>
                                                @error('categories')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-4" id="saveBtn"
                                                disabled>Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadImageModalLabel">Upload New Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadImageForm" action="{{ url('admin/update-brand-image/' . $brand->id) }}"
                enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="brandImage" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="brandImage" name="brandImage" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('backend.admin.components.footer')

<script>
    document.getElementById('editBrandBtn').addEventListener('click', () => {
        document.querySelectorAll('#brandForm input, #brandForm textarea, #brandForm select, .categories').forEach((input) => {
            input.disabled = false;
        });
        document.getElementById('saveBtn').disabled = false;
    });

    document.getElementById('deleteBrandBtn').addEventListener('click', (event) => {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this brand? This action cannot be undone.')) {
            window.location.href = event.target.href;
        }
    });
</script>
