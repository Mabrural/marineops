@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <!-- Alert Notification Container -->
            <div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999; width: 350px;"></div>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <div>
                    <h3 class="fw-bold mb-0">Projects</h3>
                    <p class="text-muted mb-0">
                        Projects registered for this company
                    </p>
                </div>
                <div>
                    <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>
                        New Project
                    </a>
                </div>
            </div>

            <!-- Desktop Table -->
            <div class="card d-none d-lg-block mt-3">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Project</th>
                                    <th>Client</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    {{-- <th>Created By / At</th> --}}
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration + ($projects->currentPage() - 1) * $projects->perPage() }}
                                        </td>

                                        <td>
                                            <a href="{{ route('projects.show', $project) }}"
                                                class="fw-bold text-decoration-none">
                                                PRJ-{{ $project->period->name ?? '-' }}-{{ str_pad($project->project_number, 3, '0', STR_PAD_LEFT) }}
                                            </a>
                                            <div class="small text-muted">
                                                Contract: Rp {{ number_format($project->contract_value, 0, ',', '.') }}
                                            </div>
                                        </td>


                                        <td>
                                            {{ $project->client->name ?? '-' }}
                                        </td>

                                        <td>
                                            <span class="badge bg-secondary text-capitalize">
                                                {{ str_replace('_', ' ', $project->type) }}
                                            </span>
                                        </td>

                                        <td>
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
                                        </td>

                                        {{-- <td>
                                            <div class="small">
                                                {{ $project->creator->name ?? '-' }}<br>
                                                <span class="text-muted">
                                                    {{ $project->created_at->format('d M Y') }}
                                                </span>
                                            </div>
                                        </td> --}}

                                        <td class="text-nowrap">
                                            <a href="{{ route('projects.show', $project) }}"
                                                class="btn btn-sm btn-primary">
                                                Open
                                            </a>

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('projects.edit', $project) }}">
                                                            Edit Project
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('projects.destroy', $project) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Delete this project?')">
                                                            @csrf @method('DELETE')
                                                            <button class="dropdown-item text-danger">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            No projects registered yet
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mobile Card List -->
            <div class="d-lg-none mt-3">
                @forelse ($projects as $project)
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1">
                                        PRJ-{{ $project->period->name ?? '-' }}-{{ str_pad($project->project_number, 3, '0', STR_PAD_LEFT) }}
                                    </h5>

                                    <p class="mb-1 text-muted small">
                                        Client: {{ $project->client->name ?? '-' }}<br>
                                        Type: {{ str_replace('_', ' ', $project->type) }}<br>
                                        Contract Value: Rp {{ number_format($project->contract_value, 2, ',', '.') }}
                                    </p>

                                    <span class="badge bg-{{ $statusColors[$project->status] ?? 'secondary' }}">
                                        {{ ucfirst($project->status) }}
                                    </span>

                                    {{-- <p class="mb-0 text-muted small mt-2">
                                        Created by {{ $project->creator->name ?? '-' }}<br>
                                        {{ $project->created_at->format('d M Y') }}
                                    </p> --}}
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('projects.show', $project) }}"
                                        class="btn btn-sm btn-primary w-100 mb-2">
                                        Open Project
                                    </a>

                                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                        onsubmit="return confirm('Delete this project?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        No projects available
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- SweetAlert & Alert Script (SAMA DENGAN CARGO) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            showAlert('success', '{{ session('success') }}');
        @endif

        @if (session('error'))
            showAlert('error', '{{ session('error') }}');
        @endif

        @if ($errors->any())
            showAlert('error', '{{ $errors->first() }}');
        @endif

        function showAlert(type, message) {
            const alertContainer = document.getElementById('alertContainer');
            const alertId = 'alert-' + Date.now();

            const alertEl = document.createElement('div');
            alertEl.id = alertId;
            alertEl.className = `alert alert-${type} alert-dismissible fade show shadow-sm`;
            alertEl.role = 'alert';

            alertEl.innerHTML = `
            <div class="d-flex align-items-center">
                <div class="me-2">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div>
                    <strong>${type.toUpperCase()}!</strong> ${message}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

            alertContainer.appendChild(alertEl);

            setTimeout(() => {
                alertEl.remove();
            }, 5000);
        }
    </script>
@endsection
