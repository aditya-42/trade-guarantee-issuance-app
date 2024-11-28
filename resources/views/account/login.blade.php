@extends('layouts.app')
@section('main')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="form-container">
          {{-- Success Message --}}
          @if (Session::has('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
          @endif

          {{-- General Error Message --}}
          @if (Session::has('error'))
            <div class="alert alert-danger">
              {{ Session::get('error') }}
            </div>
          @endif

          <h4 class="text-center mb-4">Login</h4>
          <form action="{{ route('account.authenticate') }}" method="post">
            @csrf 
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input 
                type="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                placeholder="Enter your email" 
                value="{{ old('email') }}" 
                >
              @error('email')
                <p class="invalid-feedback">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input 
                type="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror" 
                id="password" 
                placeholder="Enter your password" 
                >
              @error('password')
                <p class="invalid-feedback">{{ $message }}</p>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
          <div class="divider my-3"></div>
          <p class="text-center">
            Don't have an account? <a href="{{ route('account.register') }}">Register here</a>.
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
