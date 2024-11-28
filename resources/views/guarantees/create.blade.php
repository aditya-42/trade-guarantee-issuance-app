@extends('layouts.app')

@section('main')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <h4 class="mb-4">Create Guarantee</h4>
            <form action="{{ route('guarantees.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="corporate_reference_number" class="form-label">Corporate Reference Number</label>
                    <input type="text" name="corporate_reference_number" class="form-control @error('corporate_reference_number') is-invalid @enderror" value="{{ old('corporate_reference_number') }}">
                    @error('corporate_reference_number')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="guarantee_type" class="form-label">Guarantee Type</label>
                    <select name="guarantee_type" class="form-select @error('guarantee_type') is-invalid @enderror">
                        <option value="">Select a type</option>
                        <option value="Bank" {{ old('guarantee_type') == 'Bank' ? 'selected' : '' }}>Bank</option>
                        <option value="Bid Bond" {{ old('guarantee_type') == 'Bid Bond' ? 'selected' : '' }}>Bid Bond</option>
                        <option value="Insurance" {{ old('guarantee_type') == 'Insurance' ? 'selected' : '' }}>Insurance</option>
                        <option value="Surety" {{ old('guarantee_type') == 'Surety' ? 'selected' : '' }}>Surety</option>
                    </select>
                    @error('guarantee_type')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nominal_amount" class="form-label">Nominal Amount</label>
                    <input type="text" name="nominal_amount" class="form-control @error('nominal_amount') is-invalid @enderror" value="{{ old('nominal_amount') }}">
                    @error('nominal_amount')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nominal_amount_currency" class="form-label">Nominal Amount Currency</label>
                    <input type="text" name="nominal_amount_currency" class="form-control @error('nominal_amount_currency') is-invalid @enderror" value="{{ old('nominal_amount_currency') }}">
                    @error('nominal_amount_currency')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="expiry_date" class="form-label">Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror" value="{{ old('expiry_date') }}">
                    @error('expiry_date')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="applicant_name" class="form-label">Applicant Name</label>
                    <input type="text" name="applicant_name" class="form-control @error('applicant_name') is-invalid @enderror" value="{{ old('applicant_name') }}">
                    @error('applicant_name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="applicant_address" class="form-label">Applicant Address</label>
                    <textarea name="applicant_address" class="form-control @error('applicant_address') is-invalid @enderror">{{ old('applicant_address') }}</textarea>
                    @error('applicant_address')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="beneficiary_name" class="form-label">Beneficiary Name</label>
                    <input type="text" name="beneficiary_name" class="form-control @error('beneficiary_name') is-invalid @enderror" value="{{ old('beneficiary_name') }}">
                    @error('beneficiary_name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="beneficiary_address" class="form-label">Beneficiary Address</label>
                    <textarea name="beneficiary_address" class="form-control @error('beneficiary_address') is-invalid @enderror">{{ old('beneficiary_address') }}</textarea>
                    @error('beneficiary_address')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Guarantee</button>
            </form>
        </div>
    </div>
</div>
@endsection
