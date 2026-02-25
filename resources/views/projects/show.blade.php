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
            <ul class="nav nav-tabs mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#overview" role="tab">
                        Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#documents" role="tab">
                        Documents
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#voyage" role="tab">
                        Voyage
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#timesheet" role="tab">
                        Timesheet
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                {{-- ================= OVERVIEW ================= --}}
                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="fw-semibold mb-3">Project Overview</h5>

                            <p class="text-muted mb-4">
                                This project represents an operational contract registered in the system.
                                Voyage, cargo, and timesheet data will appear here once operational activities begin.
                            </p>

                            <div class="border rounded p-4 text-center">
                                <i class="fas fa-ship fa-2x text-muted mb-2"></i>

                                <h6 class="fw-semibold mb-1">No Voyage Created</h6>
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
                {{-- ================= DOCUMENTS ================= --}}
                <div class="tab-pane fade" id="documents" role="tabpanel">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-semibold mb-0">Project Documents</h5>
                            </div>

                            <div class="text-muted small mb-2">
                                Document upload and verification will be enabled once the document module is active.
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 60px;">No</th>
                                            <th>Document Name</th>
                                            <th style="width: 160px;">Status</th>
                                            <th style="width: 160px; text-align:center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($documentTypes as $index => $document)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $index + 1 }}
                                                </td>

                                                <td>
                                                    {{ $document->name }}
                                                </td>

                                                <td>
                                                    <span class="badge bg-warning text-dark">
                                                        Belum diupload
                                                    </span>
                                                </td>

                                                <td class="text-center">
                                                    <label class="btn btn-outline-secondary btn-xs mb-0">
                                                        <i class="fas fa-upload fa-sm me-1"></i> Upload
                                                        <input type="file" name="upload" class="d-none">
                                                    </label>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-3">
                                                    No document types available
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            

                        </div>
                    </div>
                </div>

                {{-- ================= VOYAGE ================= --}}
                <div class="tab-pane fade" id="voyage" role="tabpanel">
                    <div class="card">
                        <div class="card-body text-center p-5">
                            <i class="fas fa-route fa-2x text-muted mb-3"></i>

                            <h6 class="fw-semibold">No Voyage Data</h6>
                            <p class="text-muted small mb-4">
                                Voyage information for this project has not been created yet.
                            </p>

                            <button class="btn btn-primary btn-sm" disabled>
                                + Add Voyage
                            </button>

                            <div class="small text-muted mt-2">
                                (Will be connected to voyage table)
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= TIMESHEET ================= --}}
                <div class="tab-pane fade" id="timesheet" role="tabpanel">
                    <div class="card">
                        <div class="card-body text-center p-5">
                            <i class="fas fa-clock fa-2x text-muted mb-3"></i>

                            <h6 class="fw-semibold">No Timesheet Available</h6>
                            <p class="text-muted small mb-4">
                                Crew working hours and operational logs will appear here.
                            </p>

                            <button class="btn btn-primary btn-sm" disabled>
                                + Add Timesheet
                            </button>

                            <div class="small text-muted mt-2">
                                (Timesheet module coming soon)
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= DOCUMENTS =================
                <div class="tab-pane fade" id="documents" role="tabpanel">
                    <div class="card">
                        <div class="card-body text-center p-5">
                            <i class="fas fa-file-alt fa-2x text-muted mb-3"></i>

                            <h6 class="fw-semibold">No Documents Uploaded</h6>
                            <p class="text-muted small mb-4">
                                Contracts, invoices, and voyage documents will be stored here.
                            </p>

                            <button class="btn btn-primary btn-sm" disabled>
                                + Upload Document
                            </button>

                            <div class="small text-muted mt-2">
                                (Document management coming soon)
                            </div>
                        </div>
                    </div>
                </div> --}}


            </div>

        </div>
    </div>
@endsection

{{-- dibawah ini agar tab nya tidak balik ke awal ketika di refresh --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('a[data-bs-toggle="tab"]');

            // 🔹 Restore last active tab
            const activeTab = localStorage.getItem('projectDetailActiveTab');
            if (activeTab) {
                const triggerEl = document.querySelector(`a[href="${activeTab}"]`);
                if (triggerEl) {
                    new bootstrap.Tab(triggerEl).show();
                }
            }

            // 🔹 Save active tab on change
            tabLinks.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function(e) {
                    localStorage.setItem('projectDetailActiveTab', e.target.getAttribute('href'));
                });
            });
        });
    </script>
@endpush
