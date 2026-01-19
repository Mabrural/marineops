@extends('layouts.main')

@section('container')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Edit Company</h4>
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
                    <a href="{{ route('companies.index') }}">Company</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit Company</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Company Information</div>
                    </div>

                    <form method="POST" action="{{ route('companies.update', $company) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">

                                <!-- Company Name -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               name="name"
                                               value="{{ old('name', $company->name) }}"
                                               placeholder="e.g. PT Global Maritim Nusantara"
                                               required>

                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active"
                                                id="is_active"
                                                class="form-control @error('is_active') is-invalid @enderror">
                                            <option value="1" {{ old('is_active', $company->is_active) == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ old('is_active', $company->is_active) == 0 ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>

                                        @error('is_active')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-action">
                            <button type="submit" class="btn btn-primary">
                                Update Company
                            </button>
                            <a href="{{ route('companies.index') }}" class="btn btn-danger">
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
