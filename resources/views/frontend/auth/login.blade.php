<!-- Header Section Begin -->
@include("frontend.components.header")
<!-- Header Section End -->



<form class="col-3 mx-auto mt-5" action="{{url('/login-check-user')}}" method="post">
  @csrf
  <div class="form-outline mb-4">
    <input type="email" id="form2Example1" name="email" class="form-control" value="{{ old('email') }}" />
    <label class="form-label" for="form2Example1">Email address</label>
    @error('email')
    <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2" name="password" class="form-control" />
    <label class="form-label" for="form2Example2">Password</label>
    @error('password')
    <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

  <!-- General error message -->
  @if($errors->has('login'))
  <div class="alert alert-danger">
    {{ $errors->first('login') }}
  </div>
  @endif

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="form2Example31" name="remember" value="1" />
        <label class="form-check-label" for="form2Example31"> Remember me </label>
      </div>
    </div>

    <div class="col">
      <!-- Simple link -->
      <a href="#!">Forgot password?</a>
    </div>
  </div>

  <!-- Submit button -->
  <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block mb-4">Sign
    in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="{{ url('/register') }}">Register</a></p>
    <div class="col-12">
      <a href="{{ url('auth/google') }}" class="btn btn-primary">
        <i class="fab fa-google"></i>&nbsp; Continue with Google
      </a>
    </div>
  </div>
</form>


<!-- Footer Section Begin -->
@include("frontend.components.footer")