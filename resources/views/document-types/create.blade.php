@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Create New Document Type</h4>
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
                        <a href="{{ route('document-types.index') }}">Document Type</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Create Document Type</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Document Type Information</div>
                        </div>
                        <form method="POST" action="{{ route('document-types.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Document Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}"
                                                placeholder="e.g. RAB Keagenan" required autofocus>
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Project Type --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Project Type <span class="text-danger">*</span></label>
                                            <select id="type" class="form-control @error('type') is-invalid @enderror"
                                                name="type" required>
                                                <option value="">-- Select Type --</option>
                                                <option value="time_charter"
                                                    {{ old('type') == 'time_charter' ? 'selected' : '' }}>
                                                    Time Charter
                                                </option>
                                                <option value="freight_charter"
                                                    {{ old('type') == 'freight_charter' ? 'selected' : '' }}>
                                                    Freight Charter
                                                </option>
                                                <option value="shipping_agency"
                                                    {{ old('type') == 'shipping_agency' ? 'selected' : '' }}>
                                                    Shipping Agency
                                                </option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-primary">Create Document Type</button>
                                <a href="{{ route('document-types.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
