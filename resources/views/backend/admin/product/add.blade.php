@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title my-3">Add Product</h4>
                        <div class="basic-form">
                            <form action="{{ url('admin/product-save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control input-default"
                                        placeholder="Enter Product Name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="description" class="form-control input-default"
                                        placeholder="Enter Product Description" required>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number" name="price" class="form-control input-default"
                                        placeholder="Enter Product Price" required>
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control input-default"
                                        placeholder="Quantity" required>
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="images">Upload Images:</label>
                                    <input type="file" name="images[]" class="form-control" id="images" accept=".jpeg,.jpg,.png,.gif" multiple>
                                    @error('images')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @error('images.*')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Product Colors</label><br>
                                    <label for="red">Red</label>
                                    <input type="checkbox" name="color[]" value="red">
                                    <label for="blue">Blue</label>
                                    <input type="checkbox" name="color[]" value="blue">
                                    <label for="green">Green</label>
                                    <input type="checkbox" name="color[]" value="green">
                                    <label for="orange">Orange</label>
                                    <input type="checkbox" name="color[]" value="orange">
                                    @error('color')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Sizes</label><br>
                                    <label for="XS">XS</label>
                                    <input type="checkbox" name="size[]" value="xs">
                                    <label for="S">S</label>
                                    <input type="checkbox" name="size[]" value="s">
                                    <label for="M">M</label>
                                    <input type="checkbox" name="size[]" value="m">
                                    <label for="L">L</label>
                                    <input type="checkbox" name="size[]" value="l">
                                    <label for="XL">XL</label>
                                    <input type="checkbox" name="size[]" value="xl">
                                    @error('size')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category">Select Category</label>
                                    <select name="catagory_id" class="form-control" required>
                                        <option value="" disabled selected>Choose Category</option>
                                        @foreach ($catagories as $catagory)
                                            <option value="{{ $catagory->id }}">{{ $catagory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark mb-2">Add Product</button>
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
