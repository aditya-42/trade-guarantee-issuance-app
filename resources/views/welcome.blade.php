@extends('layouts.app')
@section('main')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10 text-center">
        <h1 class="mb-4">Welcome to Guarantee Issuance App</h1>
        <p class="mb-5">Simplifying trade guarantee issuance for your business needs.</p>
        <div class="d-flex justify-content-center gap-3">
          <a href="{{ route('account.login') }}" class="btn btn-primary btn-lg">Login</a>
          <a href="{{ route('account.register') }}" class="btn btn-outline-primary btn-lg">Register</a>
        </div>
      </div>
    </div>
  </div>
@endsection
