@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">

            <!-- Alert Notification Container -->
            <div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999; width: 350px;"></div>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <div>
                    <h3 class="fw-bold mb-0">Vessel Certificates</h3>
                    <p class="text-muted mb-0">
                        Certificates registered for company vessels
                    </p>
                </div>
                <div>
                    <a href="{{ route('vessel-certificates.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>
                        Add Certificate
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <!-- VALID -->
                <div class="col-md-4 mb-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Valid Certificates</h6>
                                    <h3 class="fw-bold text-success mb-0">
                                        {{ $certificates->filter(fn($c) => !$c->isExpired() && !$c->isExpiringSoon())->count() }}
                                    </h3>
                                </div>
                                <div class="icon-circle bg-success text-white">
                                    <i class="fas fa-check-circle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EXPIRING SOON -->
                <div class="col-md-4 mb-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Expiring Soon</h6>
                                    <h3 class="fw-bold text-warning mb-0">
                                        {{ $certificates->filter(fn($c) => $c->isExpiringSoon())->count() }}
                                    </h3>
                                </div>
                                <div class="icon-circle bg-warning text-dark">
                                    <i class="fas fa-hourglass-half fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EXPIRED -->
                <div class="col-md-4 mb-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Expired</h6>
                                    <h3 class="fw-bold text-danger mb-0">
                                        {{ $certificates->filter(fn($c) => $c->isExpired())->count() }}
                                    </h3>
                                </div>
                                <div class="icon-circle bg-danger text-white">
                                    <i class="fas fa-times-circle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .icon-circle {
                    width: 48px;
                    height: 48px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
            </style>

            <!-- FILTER BAR -->
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row g-2 align-items-end">

                        <!-- SEARCH -->
                        <div class="col-md-4">
                            <label class="form-label small">Search Certificate / Vessel</label>
                            <input type="text" id="searchInput" class="form-control"
                                placeholder="Type certificate or vessel name...">
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
                                <option value="valid">Valid</option>
                                <option value="expiring">Expiring Soon</option>
                                <option value="expired">Expired</option>
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

            <div id="certificateTable">
                <!-- Desktop Table -->
                <div class="card d-none d-lg-block mt-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Certificate</th>
                                        <th>Vessel</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        <th>Created By / At</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($certificates as $certificate)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration + ($certificates->currentPage() - 1) * $certificates->perPage() }}
                                            </td>

                                            <td>
                                                <strong>{{ $certificate->name }}</strong>
                                            </td>

                                            <td>
                                                {{ $certificate->vessel->name ?? '-' }}
                                            </td>

                                            <td>
                                                <div class="small">
                                                    Issue:
                                                    {{ $certificate->issue_date->format('d M Y') }}<br>
                                                    Expiry:
                                                    {{ $certificate->expiry_date->format('d M Y') }}
                                                </div>
                                            </td>

                                            <td>
                                                @if ($certificate->isExpired())
                                                    <span class="badge bg-danger">Expired</span>
                                                @elseif ($certificate->isExpiringSoon())
                                                    <span class="badge bg-warning text-dark">Expiring Soon</span>
                                                @else
                                                    <span class="badge bg-success">Valid</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="small">
                                                    {{ $certificate->creator->name ?? '-' }}<br>
                                                    <span class="text-muted">
                                                        {{ $certificate->created_at->format('d M Y') }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($certificate->certificate_file)
                                                    <a href="{{ asset('storage/' . $certificate->certificate_file) }}"
                                                        target="_blank" class="btn btn-sm btn-info mb-1">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                @endif

                                                <a href="{{ route('vessel-certificates.edit', $certificate) }}"
                                                    class="btn btn-sm btn-warning mb-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('vessel-certificates.destroy', $certificate) }}"
                                                    method="POST" class="d-inline" onsubmit="confirmDelete(event)">
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
                                                No vessel certificates registered yet
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
                    @forelse ($certificates as $certificate)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1">{{ $certificate->name }}</h5>
                                        <p class="mb-1 text-muted small">
                                            Vessel: {{ $certificate->vessel->name ?? '-' }}
                                        </p>
                                        <p class="mb-1 small">
                                            Expiry:
                                            {{ $certificate->expiry_date->format('d M Y') }}
                                        </p>

                                        @if ($certificate->isExpired())
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif ($certificate->isExpiringSoon())
                                            <span class="badge bg-warning text-dark">Expiring Soon</span>
                                        @else
                                            <span class="badge bg-success">Valid</span>
                                        @endif

                                        <p class="mb-0 text-muted small mt-2">
                                            Created by {{ $certificate->creator->name ?? '-' }}<br>
                                            {{ $certificate->created_at->format('d M Y') }}
                                        </p>
                                    </div>

                                    <div class="text-end">
                                        @if ($certificate->certificate_file)
                                            <a href="{{ asset('storage/' . $certificate->certificate_file) }}"
                                                target="_blank" class="btn btn-sm btn-info mb-1">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('vessel-certificates.edit', $certificate) }}"
                                            class="btn btn-sm btn-warning mb-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('vessel-certificates.destroy', $certificate) }}"
                                            method="POST" onsubmit="confirmDelete(event)">
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
                            No vessel certificates available
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $certificates->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
            <strong>${type.toUpperCase()}!</strong> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

            alertContainer.appendChild(alertEl);

            setTimeout(() => {
                alertEl.remove();
            }, 5000);
        }

        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "This certificate will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    <script>
        function loadCertificates(url = "{{ route('vessel-certificates.index') }}") {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    search: $('#searchInput').val(),
                    vessel_id: $('#vesselFilter').val(),
                    status: $('#statusFilter').val()
                },
                success: function(response) {
                    const newTable = $(response).find('#certificateTable').html();
                    $('#certificateTable').html(newTable);
                }
            });
        }

        $('#searchInput').on('keyup', function() {
            clearTimeout(this.delay);
            this.delay = setTimeout(loadCertificates, 400);
        });

        $('#vesselFilter, #statusFilter').on('change', function() {
            loadCertificates();
        });

        $('#resetFilter').on('click', function() {
            $('#searchInput').val('');
            $('#vesselFilter').val('');
            $('#statusFilter').val('');
            loadCertificates();
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            loadCertificates($(this).attr('href'));
        });
    </script>
@endsection
