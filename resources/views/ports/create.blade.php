@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Create New Port</h4>
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
                        <a href="{{ route('ports.index') }}">Port</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Create Port</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Port Information</div>
                        </div>
                        <form method="POST" action="{{ route('ports.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Port Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}"
                                                placeholder="e.g. Batam" required autofocus>
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-primary">Create Port</button>
                                <a href="{{ route('ports.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
