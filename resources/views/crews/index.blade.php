@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">

            <!-- Alert Notification Container -->
            <div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999; width: 350px;"></div>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <div>
                    <h3 class="fw-bold mb-0">Crew List</h3>
                    <p class="text-muted mb-0">
                        Crews registered for this company
                    </p>
                </div>
                <div>
                    <a href="{{ route('crews.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>
                        Add Crew
                    </a>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row g-2 align-items-end">

                        <!-- SEARCH -->
                        <div class="col-md-4">
                            <label class="form-label small">Search Crew / Vessel</label>
                            <input type="text" id="searchInput" class="form-control"
                                placeholder="Type crew name or vessel...">
                        </div>

                        <!-- FILTER VESSEL -->
                        <div class="col-md-3">
                            <label class="form-label small">Vessel</label>
                            <select id="vesselFilter" class="form-select">
                                <option value="">All Vessels</option>
                                @foreach ($vessels as $vessel)
                                    <option value="{{ $vessel->id }}">{{ $vessel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- FILTER STATUS -->
                        <div class="col-md-3">
                            <label class="form-label small">Status</label>
                            <select id="statusFilter" class="form-select">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <!-- RESET -->
                        <div class="col-md-2">
                            <button id="resetFilter" class="btn btn-outline-secondary w-100">
                                Reset
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div id="crewTable">
                <!-- Desktop Table -->
                <div class="card d-none d-lg-block mt-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Name</th>
                                        <th>Vessel</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th>Created By / At</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($crews as $crew)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration + ($crews->currentPage() - 1) * $crews->perPage() }}
                                            </td>

                                            <td>
                                                <strong>{{ $crew->name }}</strong><br>
                                                <span class="text-muted small">
                                                    {{ $crew->gender }} • {{ $crew->nationality }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $crew->vessel->name ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $crew->position ?? '-' }}
                                            </td>

                                            <td>
                                                @if ($crew->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="small">
                                                    {{ $crew->creator->name ?? '-' }}<br>
                                                    <span class="text-muted">
                                                        {{ $crew->created_at->format('d M Y') }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                <a href="{{ route('crews.show', $crew) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('crews.edit', $crew) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('crews.destroy', $crew) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Delete this crew?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-muted">
                                                No crews registered yet
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
                    @forelse ($crews as $crew)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1">{{ $crew->name }}</h5>

                                        <p class="mb-1 text-muted small">
                                            {{ $crew->position ?? '-' }} • {{ $crew->vessel->name ?? '-' }}
                                        </p>

                                        <p class="mb-0 text-muted small">
                                            {{ $crew->gender }} • {{ $crew->nationality }}<br>
                                            Created by {{ $crew->creator->name ?? '-' }}<br>
                                            {{ $crew->created_at->format('d M Y') }}
                                        </p>

                                        <div class="mt-1">
                                            @if ($crew->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <a href="{{ route('crews.show', $crew) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('crews.edit', $crew) }}" class="btn btn-sm btn-warning mb-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('crews.destroy', $crew) }}" method="POST"
                                            onsubmit="return confirm('Delete this crew?')">
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
                            No crews available
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $crews->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>

    <!-- SweetAlert -->
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
                <div class="me-2 fs-4">
                    <i class="fas ${type === 'success' ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-danger'}"></i>
                </div>
                <div>
                    <strong>${type.toUpperCase()}</strong> ${message}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

            alertContainer.appendChild(alertEl);

            setTimeout(() => alertEl.remove(), 5000);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function loadCrews(url = "{{ route('crews.index') }}") {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    search: $('#searchInput').val(),
                    vessel_id: $('#vesselFilter').val(),
                    status: $('#statusFilter').val()
                },
                success: function(response) {
                    const newTable = $(response).find('#crewTable').html();
                    $('#crewTable').html(newTable);
                }
            });
        }

        // 🔍 Search with delay
        $('#searchInput').on('keyup', function() {
            clearTimeout(this.delay);
            this.delay = setTimeout(loadCrews, 400);
        });

        // 🔄 Filter change
        $('#vesselFilter, #statusFilter').on('change', function() {
            loadCrews();
        });

        // ♻ Reset
        $('#resetFilter').on('click', function() {
            $('#searchInput').val('');
            $('#vesselFilter').val('');
            $('#statusFilter').val('');
            loadCrews();
        });

        // 📄 Pagination AJAX
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            loadCrews($(this).attr('href'));
        });
    </script>
@endsection
