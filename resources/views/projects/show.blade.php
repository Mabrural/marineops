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
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">

                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h5 class="fw-bold mb-1">Project Summary</h5>
                            <small class="text-muted">
                                Overview of project information
                            </small>
                        </div>

                        @php
                            $statusColors = [
                                'draft' => 'secondary',
                                'active' => 'primary',
                                'finished' => 'success',
                                'cancelled' => 'danger',
                            ];
                        @endphp

                        <span class="badge bg-{{ $statusColors[$project->status] ?? 'secondary' }} px-3 py-2">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="row g-4">

                        <div class="col-md-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-light rounded p-2">
                                    <i class="fas fa-building text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Client</div>
                                    <div class="fw-semibold">
                                        {{ $project->client->name ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-light rounded p-2">
                                    <i class="fas fa-layer-group text-info"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Project Type</div>
                                    <span class="badge bg-secondary text-capitalize">
                                        {{ str_replace('_', ' ', $project->type) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-light rounded p-2">
                                    <i class="fas fa-calendar text-warning"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Period</div>
                                    <div class="fw-semibold">
                                        {{ $project->period->name ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-light rounded p-2">
                                    <i class="fas fa-money-bill-wave text-success"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Contract Value</div>
                                    <div class="fw-bold fs-5 text-success">
                                        Rp {{ number_format($project->contract_value, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-light rounded p-2">
                                    <i class="fas fa-clock text-danger"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Created Date</div>
                                    <div class="fw-semibold">
                                        {{ $project->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#overview" role="tab">
                        Overview
                    </a>
                </li>
                @if ($project->type !== 'shipping_agency')
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#vessel" role="tab">
                            Vessel
                        </a>
                    </li>
                @endif
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
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#documents" role="tab">
                        Documents
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                {{-- ================= OVERVIEW ================= --}}
                <div class="tab-pane fade" id="overview" role="tabpanel">
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

                @if ($project->type !== 'shipping_agency')
                    {{-- ================= VESSEL ================= --}}
                    <div class="tab-pane fade" id="vessel" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-semibold mb-0">Project Vessels</h5>

                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#registerVesselModal">
                                        <i class="fas fa-plus me-1"></i> Register Vessel
                                    </button>
                                </div>

                                @if ($projectVessels->count() > 0)
                                    <div class="row g-3">
                                        @foreach ($projectVessels as $pv)
                                            <div class="col-md-6 col-lg-4">
                                                <div
                                                    class="border rounded px-3 py-3 d-flex justify-content-between align-items-center">

                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-ship text-primary me-2"></i>
                                                        <span class="fw-medium">
                                                            {{ $pv->vessel->name ?? '-' }}
                                                        </span>
                                                    </div>

                                                    <button class="btn btn-sm btn-light text-danger remove-vessel"
                                                        data-url="{{ route('projects.vessels.destroy', [$project->uuid, $pv->id]) }}">
                                                        <i class="fas fa-times"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center text-muted py-5 border rounded">
                                        <i class="fas fa-ship fa-lg mb-2"></i>
                                        <div class="small">No vessel registered.</div>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <!-- Register Vessel Modal -->
                        <div class="modal fade" id="registerVesselModal" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('projects.vessels.store', $project->uuid) }}">
                                    @csrf

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Register Vessel</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Select Vessel</label>
                                                <select name="vessel_id" class="form-select" required>
                                                    <option value="">-- Choose Vessel --</option>
                                                    @foreach ($availableVessels as $vessel)
                                                        <option value="{{ $vessel->id }}">
                                                            {{ $vessel->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ================= VOYAGE ================= --}}
                <div class="tab-pane fade" id="voyage" role="tabpanel">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-semibold mb-0">Project Voyage</h5>

                                @if ($voyages->isEmpty())
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#addVoyageModal">
                                        <i class="fas fa-plus me-1"></i> Add Voyage
                                    </button>
                                @endif
                            </div>

                            @if ($voyages->isNotEmpty())
                                @php $voyage = $voyages->first(); @endphp

                                <div class="border rounded p-4">

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">SPAL Number</small>
                                            <div class="fw-semibold">{{ $voyage->spal_number }}</div>
                                        </div>

                                        <div class="col-md-6">
                                            <small class="text-muted d-block">Cargo</small>
                                            <div class="fw-semibold">
                                                {{ $voyage->cargo->name ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">Loading Port</small>
                                            <div class="fw-semibold">
                                                {{ $voyage->loadingPort->name ?? '-' }}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <small class="text-muted d-block">Discharge Port</small>
                                            <div class="fw-semibold">
                                                {{ $voyage->dischargePort->name ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted d-block">Quantity</small>
                                        <div class="fw-semibold">
                                            {{ number_format($voyage->quantity, 0) }} {{ $voyage->unit }}
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editVoyageModal">
                                            <i class="fas fa-pen me-1"></i> Edit
                                        </a>

                                        <form method="POST"
                                            action="{{ route('projects.voyage.destroy', [$project->uuid, $voyage->id]) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Delete this voyage?')">
                                                <i class="fas fa-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @else
                                <div class="text-center text-muted py-5 border rounded">
                                    <i class="fas fa-route fa-lg mb-2"></i>
                                    <div class="small">No voyage data available.</div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                @if ($voyages->isEmpty())
                    <!-- Add Voyage Modal -->
                    <div class="modal fade" id="addVoyageModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('projects.voyage.store', $project->uuid) }}">
                                @csrf

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Voyage</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">SPAL Number</label>
                                            <input type="text" name="spal_number" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Cargo</label>
                                            <select name="cargo_id" class="form-select" required>
                                                <option value="">Select Cargo</option>
                                                @foreach ($cargos as $cargo)
                                                    <option value="{{ $cargo->id }}">
                                                        {{ $cargo->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Loading Port</label>
                                                <select name="loading_port_id" class="form-select" required>
                                                    <option value="">Select Port</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{ $port->id }}">
                                                            {{ $port->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Discharge Port</label>
                                                <select name="discharge_port_id" class="form-select" required>
                                                    <option value="">Select Port</option>
                                                    @foreach ($ports as $port)
                                                        <option value="{{ $port->id }}">
                                                            {{ $port->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" name="quantity" class="form-control" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Unit</label>
                                                <input type="text" name="unit" class="form-control"
                                                    placeholder="MT / KL / etc" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light btn-sm"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Save Voyage
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @if ($voyages->isNotEmpty())
                    @php $voyage = $voyages->first(); @endphp

                    <!-- Edit Voyage Modal -->
                    <div class="modal fade" id="editVoyageModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form method="POST"
                                action="{{ route('projects.voyage.update', [$project->uuid, $voyage->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Voyage</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">SPAL Number</label>
                                            <input type="text" name="spal_number" class="form-control"
                                                value="{{ $voyage->spal_number }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Cargo</label>
                                            <select name="cargo_id" class="form-select" required>
                                                @foreach ($cargos as $cargo)
                                                    <option value="{{ $cargo->id }}"
                                                        {{ $voyage->cargo_id == $cargo->id ? 'selected' : '' }}>
                                                        {{ $cargo->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Loading Port</label>
                                                <select name="loading_port_id" class="form-select" required>
                                                    @foreach ($ports as $port)
                                                        <option value="{{ $port->id }}"
                                                            {{ $voyage->loading_port_id == $port->id ? 'selected' : '' }}>
                                                            {{ $port->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Discharge Port</label>
                                                <select name="discharge_port_id" class="form-select" required>
                                                    @foreach ($ports as $port)
                                                        <option value="{{ $port->id }}"
                                                            {{ $voyage->discharge_port_id == $port->id ? 'selected' : '' }}>
                                                            {{ $port->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" name="quantity" class="form-control"
                                                    value="{{ $voyage->quantity }}" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Unit</label>
                                                <input type="text" name="unit" class="form-control"
                                                    value="{{ $voyage->unit }}" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Update Voyage
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif


                {{-- ================= TIMESHEET ================= --}}
                <div class="tab-pane fade" id="timesheet" role="tabpanel">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-semibold mb-0">Project Timesheet</h5>

                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addTimesheetModal">
                                    + Add Timesheet
                                </button>
                            </div>

                            @if ($timesheets->isEmpty())
                                <div class="text-center text-muted py-5 border rounded">
                                    <i class="fas fa-clock fa-lg mb-2"></i>
                                    <div class="small">No timesheet data available.</div>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-sm align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Period</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($timesheets as $timesheet)
                                                <tr>
                                                    <td>
                                                        {{ $timesheet->datetime->format('d M Y H:i') }}
                                                    </td>
                                                    <td>
                                                        {{ $timesheet->period->name ?? '-' }}
                                                    </td>
                                                    <td>
                                                        {{ $timesheet->position }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-secondary">
                                                            {{ $timesheet->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ $timesheet->creator->name ?? '-' }}
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="btn-group btn-group-sm">

                                                            <!-- Edit -->
                                                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                                data-bs-target="#editTimesheetModal{{ $timesheet->id }}">
                                                                <i class="fas fa-pen"></i>
                                                            </button>

                                                            <!-- Delete -->
                                                            <form method="POST"
                                                                action="{{ route('projects.timesheets.destroy', [$project->uuid, $timesheet->id]) }}"
                                                                onsubmit="return confirm('Delete this timesheet?')">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button class="btn btn-outline-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Add Timesheet Modal -->
                <div class="modal fade" id="addTimesheetModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('projects.timesheets.store', $project->uuid) }}">
                            @csrf

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Timesheet</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label">Date & Time</label>
                                        <input type="datetime-local" name="datetime" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Position</label>
                                        <input type="text" name="position" class="form-control" maxlength="50"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" maxlength="255"
                                            placeholder="On Duty / Standby / Sailing" required>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                                        Cancel
                                    </button>

                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Save Timesheet
                                    </button>
                                </div>

                            </div>
                        </form>
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
                                Upload dan verifikasi dokumen hanya dapat dilakukan dalam format .PDF dengan ukuran maksimal
                                10 MB.

                                Jika dokumen terdiri dari lebih dari satu file, harap digabung (merge) terlebih dahulu
                                menjadi satu file PDF sebelum diunggah.
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 60px;">No</th>
                                            <th>Document Name</th>
                                            <th style="width: 130px;">Status</th>
                                            <th style="width: 260px; text-align:center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($documentTypes as $index => $document)
                                            @php
                                                $upload = $document->uploads->first();
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>

                                                <td>{{ $document->name }}</td>

                                                <td>
                                                    @if ($upload)
                                                        <span class="badge bg-success">
                                                            Uploaded
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">
                                                            Belum diupload
                                                        </span>
                                                    @endif
                                                </td>

                                                <td class="text-center">

                                                    @if ($upload)
                                                        <a href="{{ asset('storage/' . $upload->attachment) }}"
                                                            target="_blank" class="btn btn-outline-success btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <label class="btn btn-outline-primary btn-sm mb-0">
                                                            <i class="fas fa-sync"></i>
                                                            <input type="file" class="d-none auto-upload"
                                                                data-url="{{ route('project-documents.upload', [$project->uuid, $document->id]) }}">
                                                        </label>

                                                        <button class="btn btn-outline-danger btn-sm delete-doc"
                                                            data-url="{{ route('project-documents.destroy', [$project->uuid, $document->id]) }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @else
                                                        <label class="btn btn-outline-secondary btn-sm mb-0">
                                                            <i class="fas fa-upload"></i>
                                                            <input type="file" class="d-none auto-upload"
                                                                data-url="{{ route('project-documents.upload', [$project->uuid, $document->id]) }}">
                                                        </label>
                                                    @endif

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('change', async function(e) {

            if (!e.target.classList.contains('auto-upload')) return;

            const input = e.target;
            const file = input.files[0];
            if (!file) return;

            const url = input.dataset.url;
            const row = input.closest('tr');

            const formData = new FormData();
            formData.append('file', file);

            try {

                Swal.fire({
                    title: 'Uploading...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(data.message ?? 'Upload failed');
                }

                // update status
                row.querySelector('td:nth-child(3)').innerHTML =
                    `<span class="badge bg-success">Uploaded</span>`;

                // update action
                row.querySelector('td:nth-child(4)').innerHTML = `
            <a href="${data.file_url}" target="_blank"
               class="btn btn-outline-success btn-sm">
                <i class="fas fa-eye"></i>
            </a>

            <label class="btn btn-outline-primary btn-sm mb-0">
                <i class="fas fa-sync"></i>
                <input type="file"
                       class="d-none auto-upload"
                       data-url="${url}">
            </label>

            <button class="btn btn-outline-danger btn-sm delete-doc"
                    data-url="${url.replace('/upload','')}">
                <i class="fas fa-trash"></i>
            </button>
        `;

                Swal.fire({
                    icon: 'success',
                    title: 'Uploaded',
                    timer: 1200,
                    showConfirmButton: false
                });

            } catch (error) {

                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: error.message ?? 'Please try again'
                });

            } finally {
                input.value = '';
            }

        });



        document.addEventListener('click', async function(e) {

            if (!e.target.closest('.delete-doc')) return;

            const btn = e.target.closest('.delete-doc');
            const url = btn.dataset.url;
            const row = btn.closest('tr');

            const confirm = await Swal.fire({
                icon: 'warning',
                title: 'Delete document?',
                text: 'File will be permanently deleted',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete'
            });

            if (!confirm.isConfirmed) return;

            try {

                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(data.message ?? 'Delete failed');
                }

                // reset row
                row.querySelector('td:nth-child(3)').innerHTML =
                    `<span class="badge bg-warning text-dark">Belum diupload</span>`;

                row.querySelector('td:nth-child(4)').innerHTML = `
            <label class="btn btn-outline-secondary btn-sm mb-0">
                <i class="fas fa-upload"></i>
                <input type="file"
                       class="d-none auto-upload"
                       data-url="${url + '/upload'}">
            </label>
        `;

                Swal.fire({
                    icon: 'success',
                    title: 'Deleted',
                    timer: 1200,
                    showConfirmButton: false
                });

            } catch (error) {

                Swal.fire({
                    icon: 'error',
                    title: 'Delete Failed',
                    text: error.message ?? 'Please try again'
                });

            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.remove-vessel').forEach(button => {

                button.addEventListener('click', function() {

                    let url = this.dataset.url;

                    if (confirm('Remove this vessel from project?')) {

                        fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                }
                            });

                    }
                });

            });

        });
    </script>
@endpush
