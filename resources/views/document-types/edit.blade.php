@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Document Type</h4>
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
                        <a href="#">Edit Document Type</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Document Type Information</div>
                        </div>

                        <form method="POST"
                            action="{{ route('document-types.update', $documentType) }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">
                                    {{-- Document Name --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">
                                                Document Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="name"
                                                name="name"
                                                value="{{ old('name', $documentType->name) }}"
                                                required autofocus>

                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Project Type --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-block mb-2">
                                                Project Type <span class="text-danger">*</span>
                                            </label>

                                            <div class="btn-group project-type-group" role="group">
                                                @php
                                                    $selectedType = old('type', $documentType->type);
                                                @endphp

                                                <input type="radio" class="btn-check" name="type"
                                                    id="time_charter"
                                                    value="time_charter"
                                                    {{ $selectedType === 'time_charter' ? 'checked' : '' }} required>
                                                <label class="btn btn-outline-primary" for="time_charter">
                                                    Time Charter
                                                </label>

                                                <input type="radio" class="btn-check" name="type"
                                                    id="freight_charter"
                                                    value="freight_charter"
                                                    {{ $selectedType === 'freight_charter' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="freight_charter">
                                                    Freight Charter
                                                </label>

                                                <input type="radio" class="btn-check" name="type"
                                                    id="shipping_agency"
                                                    value="shipping_agency"
                                                    {{ $selectedType === 'shipping_agency' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="shipping_agency">
                                                    Shipping Agency
                                                </label>
                                            </div>

                                            @error('type')
                                                <div class="text-danger small mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- CSS (sama persis dengan create) --}}
                                    <style>
                                        .project-type-group .btn {
                                            min-width: 160px;
                                        }

                                        @media (max-width: 576px) {
                                            .project-type-group {
                                                display: flex;
                                                flex-direction: column;
                                                width: 100%;
                                            }

                                            .project-type-group .btn {
                                                width: 100%;
                                                margin-bottom: 0.5rem;
                                                border-radius: 0.375rem !important;
                                            }

                                            .project-type-group .btn + .btn {
                                                margin-left: 0 !important;
                                            }
                                        }
                                    </style>
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-primary">
                                    Update Document Type
                                </button>
                                <a href="{{ route('document-types.index') }}"
                                    class="btn btn-danger">
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