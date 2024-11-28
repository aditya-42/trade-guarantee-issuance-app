@extends('layouts.app')

@section('main')
<div class="container mt-5">
    <h4 class="mb-4">Bulk Upload Guarantee Files</h4>
    <form action="{{ route('guarantees.uploadFile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose File (CSV, JSON, XML)</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Upload</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection
