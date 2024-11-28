@extends('layouts.app')
@section('main')
<div class="profile-card text-center">
    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-image">
    <h2 class="profile-name">{{ Auth::user()->name }}</h2>
    <p class="profile-email">{{ Auth::user()->role }}</p>
    <div class="profile-actions">
        <button class="btn btn-primary" onclick="location.href='{{ route('guarantees.create') }}'">Create Guarantee</button>
        <!-- <button class="btn btn-primary" onclick="location.href='{{ route('guarantees.upload') }}'">Bulk Upload</button>
        <button class="btn btn-primary" onclick="location.href='{{ route('guarantees.list_files') }}'">List Files</button> -->
        <button class="btn btn-primary" onclick="location.href='{{ route('guarantees.index') }}'" >View Guarantees</button>
        <button class="btn btn-secondary" onclick="location.href='{{ route('account.logout') }}'">Logout</button>
    </div>
</div>
@endsection
