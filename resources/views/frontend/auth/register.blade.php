<!-- Header Section Begin -->
@include("frontend.components.header")
<!-- Header Section End -->



<form class="col-3 mx-auto mt-2" action="{{ url('/register-save-user') }}" method="post">
  @csrf
  <!-- user name input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" class="form-control" name="name" />
    <label class="form-label">User Name </label>
  </div>

  <!-- Email input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="email" class="form-control" name="email" />
    <label class="form-label">Email address</label>
  </div>

  <!-- Password input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="password" class="form-control" name="password" />
    <label class="form-label">Password</label>
  </div>


  <!-- Password input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="password" class="form-control" name="password_confirmation" />
    <label class="form-label"> Confirm Password</label>
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="form2Example31" />
        <label class="form-check-label" for="form2Example31"> Accept terms and condations </label>
      </div>
    </div>

  </div>

  <!-- Submit button -->
  <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block mb-4">Sign
    up</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Already have an account ? <a href="{{ url('/login') }}">Login</a></p>

    <div class="col-12">
      <a href="{{ url('auth/google') }}" class="btn btn-primary">
        <i class="fab fa-google"></i>&nbsp; Continue with Google
      </a>
    </div>



  </div>
</form>


<!-- Footer Section Begin -->
@include("frontend.components.footer")