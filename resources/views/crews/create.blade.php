@extends('layouts.main')

@section('container')
<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h4 class="page-title">Create New Crew</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('crews.index') }}">Crew</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Create Crew</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="card-title">Crew Information</div>
                    </div>

                    <form method="POST" action="{{ route('crews.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="row">

                                <!-- Vessel -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vessel_id">Vessel <span class="text-danger">*</span></label>
                                        <select
                                            class="form-control @error('vessel_id') is-invalid @enderror"
                                            id="vessel_id"
                                            name="vessel_id"
                                            required>
                                            <option value="">-- Select Vessel --</option>
                                            @foreach ($vessels as $vessel)
                                                <option value="{{ $vessel->id }}"
                                                    {{ old('vessel_id') == $vessel->id ? 'selected' : '' }}>
                                                    {{ $vessel->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vessel_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Crew Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name"
                                            name="name"
                                            value="{{ old('name') }}"
                                            placeholder="e.g. John Doe"
                                            required>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">Gender <span class="text-danger">*</span></label>
                                        <select class="form-control @error('gender') is-invalid @enderror"
                                            id="gender"
                                            name="gender"
                                            required>
                                            <option value="Male" {{ old('gender', 'Male') === 'Male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Date of Birth -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date"
                                            class="form-control @error('date_of_birth') is-invalid @enderror"
                                            id="date_of_birth"
                                            name="date_of_birth"
                                            value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nationality -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nationality">Nationality</label>
                                        <input type="text"
                                            class="form-control @error('nationality') is-invalid @enderror"
                                            id="nationality"
                                            name="nationality"
                                            value="{{ old('nationality', 'Indonesia') }}">
                                        @error('nationality')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Seafarer Code -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="seafarer_code">Seafarer Code</label>
                                        <input type="text"
                                            class="form-control @error('seafarer_code') is-invalid @enderror"
                                            id="seafarer_code"
                                            name="seafarer_code"
                                            value="{{ old('seafarer_code') }}">
                                        @error('seafarer_code')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Seafarer Book Number -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="seafarer_book_number">Seafarer Book Number</label>
                                        <input type="text"
                                            class="form-control @error('seafarer_book_number') is-invalid @enderror"
                                            id="seafarer_book_number"
                                            name="seafarer_book_number"
                                            value="{{ old('seafarer_book_number') }}">
                                        @error('seafarer_book_number')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Seafarer Book Expired -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="seafarer_book_expired_at">Seafarer Book Expired</label>
                                        <input type="date"
                                            class="form-control @error('seafarer_book_expired_at') is-invalid @enderror"
                                            id="seafarer_book_expired_at"
                                            name="seafarer_book_expired_at"
                                            value="{{ old('seafarer_book_expired_at') }}">
                                        @error('seafarer_book_expired_at')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Position -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text"
                                            class="form-control @error('position') is-invalid @enderror"
                                            id="position"
                                            name="position"
                                            value="{{ old('position') }}">
                                        @error('position')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Certificate -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="certificate">Certificate</label>
                                        <input type="text"
                                            class="form-control @error('certificate') is-invalid @enderror"
                                            id="certificate"
                                            name="certificate"
                                            value="{{ old('certificate') }}">
                                        @error('certificate')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Certificate Number -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="certificate_number">Certificate Number</label>
                                        <input type="text"
                                            class="form-control @error('certificate_number') is-invalid @enderror"
                                            id="certificate_number"
                                            name="certificate_number"
                                            value="{{ old('certificate_number') }}">
                                        @error('certificate_number')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-action">
                            <button type="submit" class="btn btn-primary">
                                Create Crew
                            </button>
                            <a href="{{ route('crews.index') }}" class="btn btn-danger">
                                Cancel
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
