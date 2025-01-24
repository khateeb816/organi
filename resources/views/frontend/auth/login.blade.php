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
          <input class="form-check-input" type="checkbox" value="" id="form2Example31" required />
          <label class="form-check-label" for="form2Example31"> Remember me </label>
        </div>
      </div>

      <div class="col">
        <!-- Simple link -->
        <a  href="#!">Forgot password?</a>
      </div>
    </div>

    <!-- Submit button -->
    <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block mb-4">Sign in</button>

    <!-- Register buttons -->
    <div class="text-center">
      <p>Not a member? <a href="{{ url('/register') }}">Register</a></p>

      <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block mb-4 d-flex justify-content-center align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google me-2" viewBox="0 0 16 16">
            <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
          </svg> &nbsp;  Continue with Google
      </button>


    </div>
  </form>


   <!-- Footer Section Begin -->
   @include("frontend.components.footer")
