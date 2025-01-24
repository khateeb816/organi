  <!-- Header Section Begin -->
  @include('frontend.components.header')
  <!-- Header Section End -->


  <!-- Hero Section Begin -->
  <section class="hero hero-normal">
      <div class="container">
          <div class="row">
              <div class="col-lg-3">
                  <div class="hero__categories">
                      <div class="hero__categories__all">
                          <i class="fa fa-bars"></i>
                          <span>All departments</span>
                      </div>
                      <ul>
                          <li><a href="#">Fresh Meat</a></li>
                          <li><a href="#">Vegetables</a></li>
                          <li><a href="#">Fruit & Nut Gifts</a></li>
                          <li><a href="#">Fresh Berries</a></li>
                          <li><a href="#">Ocean Foods</a></li>
                          <li><a href="#">Butter & Eggs</a></li>
                          <li><a href="#">Fastfood</a></li>
                          <li><a href="#">Fresh Onion</a></li>
                          <li><a href="#">Papayaya & Crisps</a></li>
                          <li><a href="#">Oatmeal</a></li>
                          <li><a href="#">Fresh Bananas</a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-9">
                  <div class="hero__search">
                      <div class="hero__search__form">
                          <form action="#">
                              <div class="hero__search__categories">
                                  All Categories
                                  <span class="arrow_carrot-down"></span>
                              </div>
                              <input type="text" placeholder="What do yo u need?">
                              <button type="submit" class="site-btn">SEARCH</button>
                          </form>
                      </div>
                      <div class="hero__search__phone">
                          <div class="hero__search__phone__icon">
                              <i class="fa fa-phone"></i>
                          </div>
                          <div class="hero__search__phone__text">
                              <h5>+65 11.188.888</h5>
                              <span>support 24/7 time</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Hero Section End -->

  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontendAssets/img/breadcrumb.jpg') }}">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 text-center">
                  <div class="breadcrumb__text">
                      <h2>Shopping Cart</h2>
                      <div class="breadcrumb__option">
                          <a href="./index.html">Home</a>
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
                                  $discount = 0;
                              @endphp
                              @foreach ($carts as $cart)
                                  <tr>
                                      <td class="shoping__cart__item">
                                          <img src="{{ asset($cart->product->image) }}">
                                          <h5>{{ $cart->product->name }}</h5>
                                      </td>
                                      <td class="shoping__cart__price">
                                          ${{ $cart->product->price }}
                                      </td>
                                      <td class="shoping__cart__quantity" style="width:50px;">
                                          <div class="quantity">
                                              <input type="text" value="{{ $cart->quantity }}" class="form-control"
                                                  disabled data-cart-id="{{ $cart->id }}">
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
              <div class="col-lg-6">
                  <div class="shoping__continue">
                      <div class="shoping__discount">
                          <h5>Discount Codes</h5>
                          <form action="#">
                              <input type="text" placeholder="Enter your coupon code">
                              <button type="submit" class="site-btn">APPLY COUPON</button>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="shoping__checkout">
                      <h5>Cart Total</h5>
                      <ul>
                          <li>Subtotal <span>${{ $subtotal }}.00</span></li>
                          <li>Total <span>${{ $subtotal - $discount }}.00</span></li>
                      </ul>
                      <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Shoping Cart Section End -->

  <script>
      document.addEventListener("DOMContentLoaded", function () {
    const editCartBtn = document.getElementById("edit-cart-btn");
    const quantityInputs = document.querySelectorAll(".shoping__cart__quantity input");

    let isEditing = false;

    editCartBtn.addEventListener("click", function () {
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
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ cart: updatedCart })
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
