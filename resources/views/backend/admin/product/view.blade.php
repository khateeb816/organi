@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<style>
    .product-image {
        max-height: 400px;
        object-fit: cover;
    }
    .carousel-item img {
        max-height: 400px;
        object-fit: cover;
        width: 100%;
    }
</style>

<div class="content-body p-3 bg-light">
    <div class="container mt-5">
        <div class="row">
            <!-- Product Images Carousel -->
            <div class="col-md-6 mb-4">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                        @endphp
                        @if (!empty($images) && is_array($images))
                            @foreach ($images as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ asset($image) }}" class="d-block w-100 cover" alt="Product Image">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <p class="text-center">No Images Uploaded</p>
                            </div>
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h2 class="mb-3">{{ $product->name }}</h2>
                <p class="text-muted mb-4">Product ID: {{ $product->id }}</p>
                <div class="mb-3">
                    <span class="h4 me-2">PKR {{ number_format($product->price, 2) }}</span>
                </div>
                <div class="mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                    <span class="ms-2">4.5 (120 reviews)</span>
                </div>
                <p class="mb-4">{{ $product->description }}</p>

                <div class="mb-4">
                    <h5>Color:</h5>
                    <div class="btn-group" role="group" aria-label="Color selection">
                        @foreach (json_decode($product->color ?? '[]', true) as $color)
                            <input type="radio"
                                   class="btn-check"
                                   name="color"
                                   id="{{ $color }}"
                                   autocomplete="off">
                            <label class="btn btn-outline-dark" for="{{ $color }}">{{ ucfirst($color) }}</label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <h5>Size:</h5>
                    <div class="btn-group" role="group" aria-label="Size selection">
                        @foreach (json_decode($product->size ?? '[]', true) as $size)
                            <input type="radio"
                                   class="btn-check"
                                   name="size"
                                   id="size-{{ $size }}"
                                   autocomplete="off">
                            <label class="btn btn-outline-secondary" for="size-{{ $size }}">{{ $size }}</label>
                        @endforeach
                    </div>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number"
                           class="form-control"
                           id="quantity"
                           value="{{$product->total_items}}"
                           min="1"
                           style="width: 80px;"
                           disabled>
                </div>
                <div class="mb-4">
                    <label for="sold_items" class="form-label">Sold-Items:</label>
                    <input type="text"
                           class="form-control"
                           id="sold-items"
                           value="{{$product->sold_items}}"
                           min="1"
                           style="width: 80px;"
                           disabled>
                </div>

                <!-- Status Dropdown -->
                <div class="mb-4">
                    <label for="status" class="form-label">Status:</label>
                    <select class="form-control" id="status" name="status" disabled>
                        <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="pending" {{ $product->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="blocked" {{ $product->status === 'blocked' ? 'selected' : '' }}>Blocked</option>
                    </select>
                </div>

                <!-- State Dropdown -->
                <div class="mb-4">
                    <label for="state" class="form-label">State:</label>
                    <select class="form-control" id="state" name="state" disabled>
                        <option value="default" {{ $product->state === 'default' ? 'selected' : '' }}>Default</option>
                        <option value="hot-deals" {{ $product->state === 'hot-deals' ? 'selected' : '' }}>Hot Deals</option>
                        <option value="featured" {{ $product->state === 'featured' ? 'selected' : '' }}>Featured</option>
                    </select>
                </div>

                <a href="{{ url('admin/product') }}" class="btn btn-dark mt-3">Back to Products</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@include('backend.admin.components.footer')
