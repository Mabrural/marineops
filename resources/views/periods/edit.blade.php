@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Period</h4>
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
                        <a href="{{ route('periods.index') }}">Period</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Period</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Period Information</div>
                        </div>

                        <form method="POST" action="{{ route('periods.update', $period) }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">

                                    <!-- Period Name -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Period Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $period->name) }}"
                                                placeholder="e.g. Periode 2026" required>

                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-primary">
                                    Update Period
                                </button>
                                <a href="{{ route('periods.index') }}" class="btn btn-danger">
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
