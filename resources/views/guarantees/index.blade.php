@extends('layouts.app')

@section('main')
<div class="container mt-5">
    <h4 class="mb-4">Guarantees</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Corporate Ref. Number</th>
                <th>Type</th>
                <th>Nominal Amount</th>
                <th>Currency</th>
                <th>Expiry Date</th>
                <th>Applicant</th>
                <th>Beneficiary</th>
                <th>Status</th>
                @if (Auth::user()->role == 'admin')
                <th>Actions</th>
                @endif  
            </tr>
        </thead>
        <tbody>
            @forelse ($guarantees as $guarantee)
                <tr>
                    <td>{{ $guarantee->corporate_reference_number }}</td>
                    <td>{{ $guarantee->guarantee_type }}</td>
                    <td>{{ $guarantee->nominal_amount }}</td>
                    <td>{{ $guarantee->nominal_amount_currency }}</td>
                    <td>{{ $guarantee->expiry_date }}</td>
                    <td>{{ $guarantee->applicant_name }}</td>
                    <td>{{ $guarantee->beneficiary_name }}</td>
                    <td>{{ $guarantee->status }}</td>
                    <td>
                        @if (Auth::user()->role == 'admin')
                            @if($guarantee->status != 'approved')
                                <form action="{{ route('guarantees.approve', $guarantee->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to approve this guarantee?')">Approve</button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-success" disabled>Approved</button>
                            @endif

                            <form action="{{ route('guarantees.destroy', $guarantee->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this guarantee?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No guarantees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
