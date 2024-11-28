<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Guarantee Issuance App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
</head>
<body>

<div class="navbar">
    <div class="title" style="cursor:pointer" onclick="location.href='{{ route('account.register') }}'">Guarantee Issuance App</div>
    <div class="nav-buttons">
      @if (Auth::check())
      <button onclick="location.href='{{ route('account.profile') }}'">My Profile</button>
      @else
      <button onclick="location.href='{{ route('account.login') }}'">Login</button>
      <button onclick="location.href='{{ route('account.register') }}'">Register</button>
      @endif
      
    </div>
  </div>
 

@yield('main')


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
