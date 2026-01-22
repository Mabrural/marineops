@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">

            <div class="page-header">
                <h4 class="page-title">Edit Vessel Certificate</h4>
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
                        <a href="{{ route('vessel-certificates.index') }}">Vessel Certificates</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Certificate</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-title">Certificate Information</div>
                        </div>

                        <form method="POST" action="{{ route('vessel-certificates.update', $vesselCertificate) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">

                                    <!-- Vessel -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vessel_id">
                                                Vessel <span class="text-danger">*</span>
                                            </label>
                                            <select name="vessel_id" id="vessel_id"
                                                class="form-control @error('vessel_id') is-invalid @enderror" required>
                                                <option value="">-- Select Vessel --</option>
                                                @foreach ($vessels as $vessel)
                                                    <option value="{{ $vessel->id }}"
                                                        {{ old('vessel_id', $vesselCertificate->vessel_id) == $vessel->id ? 'selected' : '' }}>
                                                        {{ $vessel->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('vessel_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Certificate Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">
                                                Certificate Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name"
                                                value="{{ old('name', $vesselCertificate->name) }}" required>
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Issue Date -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="issue_date">
                                                Issue Date <span class="text-danger">*</span>
                                            </label>
                                            <input type="date"
                                                class="form-control @error('issue_date') is-invalid @enderror"
                                                id="issue_date" name="issue_date"
                                                value="{{ old('issue_date', $vesselCertificate->issue_date->format('Y-m-d')) }}"
                                                required>
                                            @error('issue_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Expiry Date -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expiry_date">
                                                Expiry Date <span class="text-danger">*</span>
                                            </label>
                                            <input type="date"
                                                class="form-control @error('expiry_date') is-invalid @enderror"
                                                id="expiry_date" name="expiry_date"
                                                value="{{ old('expiry_date', $vesselCertificate->expiry_date->format('Y-m-d')) }}"
                                                required>
                                            @error('expiry_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Existing Certificate File -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Certificate File</label><br>

                                            @if ($vesselCertificate->certificate_file)
                                                <a href="{{ asset('storage/' . $vesselCertificate->certificate_file) }}"
                                                    target="_blank" class="btn btn-sm btn-info mb-2">
                                                    <i class="fas fa-file-pdf me-1"></i>
                                                    View Certificate
                                                </a>
                                            @else
                                                <p class="text-muted">No file uploaded</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Upload New File -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="certificate_file">
                                                Replace Certificate File
                                            </label>
                                            <input type="file"
                                                class="form-control @error('certificate_file') is-invalid @enderror"
                                                id="certificate_file" name="certificate_file" accept=".pdf,.jpg,.jpeg,.png">
                                            <small class="text-muted">
                                                Leave empty if you don't want to change the file
                                            </small>
                                            @error('certificate_file')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-primary">
                                    Update Certificate
                                </button>
                                <a href="{{ route('vessel-certificates.index') }}" class="btn btn-danger">
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
