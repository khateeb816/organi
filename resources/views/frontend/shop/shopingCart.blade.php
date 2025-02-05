<!-- Header Section Begin -->
@include('frontend.components.header')
<!-- Header Section End -->



<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontendAssets/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $subtotal = 0;
                            @endphp
                            @foreach ($carts as $cart)
                            @php
                            $images = (array) json_decode($cart->product->images);
                            $firstImage = $images[0];
                            @endphp
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{ asset($firstImage) }}" width="100">
                                    <h5>{{ $cart->product->name }}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{ $cart->product->price }}
                                </td>
                                <td class="shoping__cart__quantity" style="width:50px;">
                                    <div class="quantity">
                                        <input type="text" value="{{ $cart->quantity }}" class="form-control" disabled
                                            data-cart-id="{{ $cart->id }}">
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    ${{ $cart->product->price * $cart->quantity }}.00
                                    @php
                                    $subtotal += $cart->product->price * $cart->quantity;
                                    @endphp
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="{{ url('/remove-cart-item', $cart->id) }}">
                                        <span class="icon_close"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <!-- Edit Cart Button -->
                    <div class="shoping__cart__btns">
                        <a href="javascript:void(0);" id="edit-cart-btn" class="primary-btn cart-btn cart-btn-right">
                            Edit Cart
                        </a>
                    </div>

                </div>
            </div>
            @if(!session('discount'))

            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="{{ url('/shopingCart') }}" method="GET">
                            <input type="text" placeholder="Enter your coupon code" required name="discount">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span>${{ number_format($subtotal, 2) }}</span></li>

                        @php
                        $discountPercentage = session('discountPrecentage', 0);
                        $discountAmount = ($subtotal * $discountPercentage) / 100;
                        $total = $subtotal - $discountAmount;
                        @endphp

                        @if ($discountPercentage)
                        <li>Discount ({{ $discountPercentage }}%) <span>- ${{ number_format($discountAmount, 2)
                                }}</span></li>
                        @endif

                        <li>Total <span>${{ number_format($total, 2) }}</span></li>
                    </ul>

                    <a href="{{ url('checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
          const editCartBtn = document.getElementById("edit-cart-btn");
          const quantityInputs = document.querySelectorAll(".shoping__cart__quantity input");

          let isEditing = false;

          editCartBtn.addEventListener("click", function() {
              isEditing = !isEditing;

              if (isEditing) {
                  // Enable all quantity inputs
                  quantityInputs.forEach(input => {
                      input.disabled = false;
                  });
                  // Change button text to "Save Cart"
                  editCartBtn.textContent = "Save Cart";
                  editCartBtn.classList.add("save-btn");
              } else {
                  // Collect updated data
                  let updatedCart = [];
                  quantityInputs.forEach(input => {
                      const cartId = input.dataset.cartId; // Get the cart_id from data attribute
                      const quantity = input.value;
                      updatedCart.push({
                          cart_id: cartId,
                          quantity: quantity
                      });
                  });

                  // Debug log updated cart data
                  console.log(updatedCart);

                  // Optional: Send AJAX request to save cart data
                  fetch("/update-cart", {
                          method: "POST",
                          headers: {
                              "Content-Type": "application/json",
                              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                  .getAttribute("content")
                          },
                          body: JSON.stringify({
                              cart: updatedCart
                          })
                      })
                      .then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              console.log("Cart updated successfully!");
                          } else {
                              console.log("Failed to update cart!");
                          }
                      })
                      .catch(error => {
                          console.error("Error updating cart:", error);
                      });

                  // Disable all quantity inputs
                  quantityInputs.forEach(input => {
                      input.disabled = true;
                  });
                  // Change button text back to "Edit Cart"
                  editCartBtn.textContent = "Edit Cart";
                  editCartBtn.classList.remove("save-btn");
              }
          });
      });
</script>


<!-- Footer Section Begin -->
@include('frontend.components.footer ');
<!-- Footer Section End -->