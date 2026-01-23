@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">

            <!-- Page Header -->
            <div class="page-header">
                <h4 class="page-title">Crew Detail</h4>
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
                        <a href="#">Detail</a>
                    </li>
                </ul>
            </div>

            <div class="row">

                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Personal Information</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <th width="40%">Name</th>
                                    <td>{{ $crew->name }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $crew->gender }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>
                                        {{ $crew->date_of_birth ? $crew->date_of_birth->format('d M Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nationality</th>
                                    <td>{{ $crew->nationality }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($crew->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Assignment</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <th width="40%">Vessel</th>
                                    <td>{{ $crew->vessel->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Position</th>
                                    <td>{{ $crew->position ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Company</th>
                                    <td>{{ $crew->company->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Created By</th>
                                    <td>
                                        {{ $crew->creator->name ?? '-' }}<br>
                                        <span class="text-muted small">
                                            {{ $crew->created_at->format('d M Y') }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="card-title">Seafarer Documents</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th width="30%">Seafarer Code</th>
                                    <td>{{ $crew->seafarer_code ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Seafarer Book Number</th>
                                    <td>{{ $crew->seafarer_book_number ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Seafarer Book Expired</th>
                                    <td>
                                        @if ($crew->seafarer_book_expired_at)
                                            {{ $crew->seafarer_book_expired_at->format('d M Y') }}

                                            @if ($crew->seafarer_book_expired_at->isPast())
                                                <span class="badge bg-danger ms-2">Expired</span>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Certificate</th>
                                    <td>{{ $crew->certificate ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Certificate Number</th>
                                    <td>{{ $crew->certificate_number ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="mt-3">
                <a href="{{ route('crews.edit', $crew) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('crews.index') }}" class="btn btn-secondary">
                    Back
                </a>
            </div>

        </div>
    </div>
@endsection
