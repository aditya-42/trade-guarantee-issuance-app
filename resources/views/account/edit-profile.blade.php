@extends('layouts.app')
@section('main')
<div class="container mt-5 d-flex justify-content-center">
  <div class="col-md-6 col-lg-5 col-xl-4 form-container">
    <h3 class="text-center">Edit Profile</h3>
    <form>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" value="John Doe" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" value="johndoe@example.com" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Save Changes</button>
    </form>
  </div>
</div>


@endsection
