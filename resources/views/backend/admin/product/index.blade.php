@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<!-- Include Bootstrap 5 CSS -->

<div class="content-body p-3 bg-light">
    <a href="{{ url('admin/product-add') }}" class="btn btn-info mb-3">Add Product</a>
    <div class="table-responsive">
        <table id="table" class="display table table-striped table-bordered w-100">
            <thead> 
                <tr>
                    <th>Sno.</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Category Name</th>
                    <th>Brand Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 2) }} PKR</td>
                        <td>
                            @php
                                $images = is_array($product->images)
                                    ? $product->images
                                    : json_decode($product->images, true);
                                $show = true;
                            @endphp
                            @if (!empty($images) && is_array($images))
                                @foreach ($images as $image)
                                    @if ($show)
                                        <img src="{{ asset($image) }}" alt="Product Image" class="img-thumbnail"
                                            width="100px">
                                        @php
                                            $show = false;
                                        @endphp
                                    @endif
                                @endforeach
                            @else
                                <span>No Images Uploaded</span>
                            @endif
                        </td>

                        <td>{{ $product->catagory->name ?? 'N/A' }}</td>
                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $product->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ url('admin/product-view/' . $product->id) }}" class="btn btn-primary btn-sm">View</a>

                            @if ($product->brand_id == Auth::user()->brand_id)
                                <a href="{{ url('admin/product-edit/' . $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif

                            <a href="{{ url('admin/product-delete/' . $product->id) }}" class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery, Bootstrap 5 JS, and DataTables JS and CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
        });
    });
</script>

@include('backend.admin.components.footer')
