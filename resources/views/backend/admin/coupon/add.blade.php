@include('backend.admin.components.header')
@include('backend.admin.components.topnavbar')
@include('backend.admin.components.aside')

<div class="content-body">
    <div class="container-fluid">
        <h1>Add Coupon</h1>
        <form action="{{ url('admin/coupon-save') }}" method="POST"

            method="POST">
            @csrf
            <div class="form-group">
                <label for="code">Coupon Code</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $coupon->code ?? '' }}"
                    required>
            </div>
            <div class="form-group">
                <label for="percentage">Coupon Percentage</label>
                <input type="number" name="percentage" id="percentage" class="form-control"
                    value="{{ $coupon->percentage ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                    value="{{ $coupon->expiry_date ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ isset($coupon) && $coupon->status == 1 ? 'selected' : '' }}>Active
                    </option>
                    <option value="0" {{ isset($coupon) && $coupon->status == 0 ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        @include('backend.admin.components.footer')
