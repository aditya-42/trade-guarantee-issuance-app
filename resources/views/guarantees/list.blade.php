@extends('layouts.app')

@section('main')
<div class="container mt-5">
    <h4 class="mb-4">Uploaded Files</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Upload Date</th>
                <th>File Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($uploadedFiles as $file)
                <tr>
                    <td>{{ $file->file_name }}</td>
                    <td>{{ $file->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $file->file_type }}</td>
                    <td>
                        <form action="{{ route('guarantees.deleteFile', $file->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No files found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
