@extends('layouts.main')

@section('container')
<div class="container">
    <div class="page-inner">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h3 class="fw-bold mb-1">
                    Project Detail
                </h3>
                <p class="text-muted mb-0">
                    PRJ-{{ $project->period->name ?? '-' }}-{{ str_pad($project->project_number, 3, '0', STR_PAD_LEFT) }}
                </p>
            </div>

            <a href="{{ route('projects.index') }}" class="btn btn-light btn-sm">
                ← Back to Projects
            </a>
        </div>

        <!-- Project Summary Card -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-4">
                        <div class="text-muted small">Client</div>
                        <div class="fw-semibold">
                            {{ $project->client->name ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-muted small">Project Type</div>
                        <span class="badge bg-secondary text-capitalize">
                            {{ str_replace('_', ' ', $project->type) }}
                        </span>
                    </div>

                    <div class="col-md-4">
                        <div class="text-muted small">Status</div>
                        @php
                            $statusColors = [
                                'draft' => 'secondary',
                                'active' => 'primary',
                                'finished' => 'success',
                                'cancelled' => 'danger',
                            ];
                        @endphp
                        <span class="badge bg-{{ $statusColors[$project->status] ?? 'secondary' }}">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>

                    <div class="col-md-4">
                        <div class="text-muted small">Contract Value</div>
                        <div class="fw-semibold">
                            Rp {{ number_format($project->contract_value, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-muted small">Period</div>
                        <div class="fw-semibold">
                            {{ $project->period->name ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-muted small">Created</div>
                        <div class="fw-semibold">
                            {{ $project->created_at->format('d M Y') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    Overview
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    Voyage
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    Timesheet
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    Documents
                </a>
            </li>
        </ul>

        <!-- Overview Content -->
        <div class="card">
            <div class="card-body">

                <h5 class="fw-semibold mb-3">
                    Project Overview
                </h5>

                <p class="text-muted mb-4">
                    This project represents an operational contract registered in the system.
                    Voyage, cargo, and timesheet data will appear here once operational activities begin.
                </p>

                <!-- Empty State (Voyage) -->
                <div class="border rounded p-4 text-center">
                    <div class="mb-2">
                        <i class="fas fa-ship fa-2x text-muted"></i>
                    </div>

                    <h6 class="fw-semibold mb-1">
                        No Voyage Created
                    </h6>

                    <p class="text-muted small mb-3">
                        This project does not have any voyage yet.
                    </p>

                    <button class="btn btn-primary btn-sm" disabled>
                        + Create Voyage
                    </button>

                    <div class="small text-muted mt-2">
                        (Voyage module coming soon)
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
