@extends('layouts.auth')
@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
  <div class="authentication-inner">
    <!-- Register Card -->
    <div class="card">
      <div class="card-body">
        <h4 class="mb-2">Register</h4>
        <p class="mb-4">Let's get started, are you ready to be part of something new ? then boldly move forward with us.</p>

        <form id="formAuthentication" class="mb-3" action="/register" method="POST">
          @csrf

          @if ($email != '')
            <input type="text" name="name" id="name" value="{{ $name }}" hidden>
            <input type="text" name="email" id="email" value="{{ $email }}" hidden>
            <input type="text" name="role_id" id="role_id" value="{{ $role_id }}" hidden>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input
                  type="password"
                  id="password"
                  class="form-control @error('password') is-invalid @enderror"
                  name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password"
                  required
                />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                @error('password')
                <small class="text-danger pt-3 pb-1">
                  {{ $message }}
                </small>
              @enderror
              </div>
            </div>
          @else
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                placeholder="Enter your name"
                autofocus
                required
              />
              @error('name')
                <small class="text-danger pt-3 pb-1">
                    {{ $message }}
                </small>
              @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" required/>
              @error('email')
                <small class="text-danger pt-3 pb-1">
                  {{ $message }}
                </small>
              @enderror
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input
                  type="password"
                  id="password"
                  class="form-control @error('password') is-invalid @enderror"
                  name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password"
                  required
                />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                @error('password')
                <small class="text-danger pt-3 pb-1">
                  {{ $message }}
                </small>
              @enderror
              </div>
            </div>
          @endif
          {{-- <div class="mb-3 form-password-toggle">
            <label for="role_id" class="form-label">Role</label>
              <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" aria-label="Default select example" required>
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                @endforeach
              </select>
              @error('role_id')
              <small class="text-danger pt-3 pb-1">
                {{ $message }}
              </small>
            @enderror
          </div> --}}
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required/>
              <label class="form-check-label" for="terms-conditions">
                I agree to
                <a href="javascript:void(0);">privacy policy & terms</a>
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary d-grid w-100" id="btn-signup" disabled>Sign up</button>
        </form>

        <p class="text-center">
          <span>Already have an account?</span>
          <a href="/auth">
            <span>Sign in instead</span>
          </a>
        </p>
        @if ($email == '')
          <div class="flex items-center justify-center mt-4 align-items-center">
            <a href="{{ route('auth.google') }}">
              <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
            </a>
          </div>
        @endif
      </div>
    </div>
    <!-- Register Card -->
  </div>
</div>

<script src="{{ asset('assets/vendor/js/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/js/select2/select2.min.js') }}"></script>
<script>
    $(document).ready(function(){
      $('#terms-conditions').on('change', function () {
        if ($(this).is(':checked')) {
            $('#btn-signup').prop('disabled', false); // Enable the button
        } else {
            $('#btn-signup').prop('disabled', true); // Disable the button
        }
      });

      // SWEET ALERT
      @if (session()->has('registration_failed'))   
          Swal.fire({
              title: "Error",
              text: "{{ session('registration_failed') }}",
              icon: "error"
          });
      @endif
    });
</script>
@endsection