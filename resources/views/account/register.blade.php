@extends('layouts.app')

@section('main')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="form-container bg-white p-4 rounded shadow">
          <h4 class="text-center mb-4">Register</h4>
          <form action="{{ route('account.processRegister') }}" method="post">
            @csrf
            <div class="mb-3">
              <label for="userType" class="form-label">Register As</label>
              <select name="userType" class="form-select @error('userType') is-invalid @enderror" id="userType">
                <option value="" disabled selected>Select role</option>
                <option value="user" {{ old('userType') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('userType') == 'admin' ? 'selected' : '' }}>Admin</option>
              </select>
              @error('userType')
                <p class="invalid-feedback">{{ $message }}</p>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Enter your username" value="{{ old('username') }}">
              @error('username')
                <p class="invalid-feedback">{{ $message }}</p>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter your email" value="{{ old('email') }}">
              @error('email')
                <p class="invalid-feedback">{{ $message }}</p>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter your password">
              @error('password')
                <p class="invalid-feedback">{{ $message }}</p>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm your password">
              @error('password_confirmation')
                <p class="invalid-feedback">{{ $message }}</p>
              @enderror
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>
          <div class="divider my-3"></div>
          <p class="text-center">
            Already have an account? <a href="{{route('account.login')}}">Login here</a>.
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
