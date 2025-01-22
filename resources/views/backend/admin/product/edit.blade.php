@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title my-3">Edit Product</h4>
                        <div class="basic-form">
                            <form action="{{ url('admin/product-update/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control input-default"
                                        placeholder="Enter Product Name" value="{{ $product->name }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="description" class="form-control input-default"
                                        placeholder="Enter Product Description" value="{{ $product->description }}" required>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number" name="price" class="form-control input-default"
                                        placeholder="Enter Product Price" value="{{ $product->price }}" required>
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control input-default"
                                        placeholder="Quantity" value="{{ $product->total_items }}" required>
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="product-images">
                                    @if ($product->images)
                                        @foreach (json_decode($product->images, true) as $image)
                                            <img src="{{ asset($image) }}" alt="Product Image" class="img-thumbnail" width="150">
                                        @endforeach
                                    @else
                                        <span>No Images Uploaded</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Product Colors</label><br>
                                    @php
                                        $selectedColors = json_decode($product->color, true) ?? [];
                                    @endphp
                                    <label for="red">Red</label>
                                    <input type="checkbox" name="color[]" value="red" {{ in_array('red', $selectedColors) ? 'checked' : '' }}>
                                    <label for="blue">Blue</label>
                                    <input type="checkbox" name="color[]" value="blue" {{ in_array('blue', $selectedColors) ? 'checked' : '' }}>
                                    <label for="green">Green</label>
                                    <input type="checkbox" name="color[]" value="green" {{ in_array('green', $selectedColors) ? 'checked' : '' }}>
                                    <label for="orange">Orange</label>
                                    <input type="checkbox" name="color[]" value="orange" {{ in_array('orange', $selectedColors) ? 'checked' : '' }}>
                                    @error('color')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Sizes</label><br>
                                    @php
                                        $selectedSizes = json_decode($product->size, true) ?? [];
                                    @endphp
                                    <label for="XS">XS</label>
                                    <input type="checkbox" name="size[]" value="xs" {{ in_array('xs', $selectedSizes) ? 'checked' : '' }}>
                                    <label for="S">S</label>
                                    <input type="checkbox" name="size[]" value="s" {{ in_array('s', $selectedSizes) ? 'checked' : '' }}>
                                    <label for="M">M</label>
                                    <input type="checkbox" name="size[]" value="m" {{ in_array('m', $selectedSizes) ? 'checked' : '' }}>
                                    <label for="L">L</label>
                                    <input type="checkbox" name="size[]" value="l" {{ in_array('l', $selectedSizes) ? 'checked' : '' }}>
                                    <label for="XL">XL</label>
                                    <input type="checkbox" name="size[]" value="xl" {{ in_array('xl', $selectedSizes) ? 'checked' : '' }}>
                                    @error('size')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category">Select Category</label>
                                    <select name="catagory_id" class="form-control" required>
                                        <option value="" disabled>Choose Category</option>
                                        @foreach ($catagories as $catagory)
                                            <option value="{{ $catagory->id }}" {{ $product->catagory_id == $catagory->id ? 'selected' : '' }}>
                                                {{ $catagory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="form-label">Status:</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="pending" {{ $product->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="blocked" {{ $product->status === 'blocked' ? 'selected' : '' }}>Blocked</option>
                                    </select>
                                </div>

                                <!-- State Dropdown -->
                                <div class="mb-4">
                                    <label for="state" class="form-label">State:</label>
                                    <select class="form-select" id="state" name="state">
                                        <option value="default" {{ $product->state === 'default' ? 'selected' : '' }}>Default</option>
                                        <option value="hot-deals" {{ $product->state === 'hot-deals' ? 'selected' : '' }}>Hot Deals</option>
                                        <option value="featured" {{ $product->state === 'featured' ? 'selected' : '' }}>Featured</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark mb-2">Update Product</button>
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
