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

            <style>
                /* EXTREME COMPACT MODE (TD ONLY)*/

                /* Jangan ubah header */
                #certificateTable .table thead th {
                    padding: 0.5rem 0.75rem !important;
                    /* normal bootstrap */
                    line-height: 1.3 !important;
                }

                /* Paksa hanya TD yang super dempet */
                #certificateTable .table tbody td {
                    padding: 1px 6px !important;
                    line-height: 1 !important;
                    vertical-align: middle !important;
                }

                /* Perkecil tinggi baris body saja */
                #certificateTable .table tbody tr {
                    height: 20px !important;
                }

                /* Hilangkan spacing tambahan */
                #certificateTable .table tbody td .badge,
                #certificateTable .table tbody td i,
                #certificateTable .table tbody td .btn {
                    margin: 0 !important;
                    padding-top: 1px !important;
                    padding-bottom: 1px !important;
                }
            </style>

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
                                        <th>Issue Date</th>
                                        <th>Expired Date</th>
                                        <th>Status</th>
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
                                                <a href="{{ asset('storage/' . $certificate->certificate_file) }}"
                                                    target="_blank">
                                                    <strong>{{ $certificate->name }}</strong>
                                                </a>
                                            </td>

                                            <td>
                                                {{ $certificate->vessel->name ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $certificate->issue_date->format('d M Y') }}
                                            </td>
                                            <td>
                                                {{ $certificate->expiry_date->format('d M Y') }}
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

                <!-- Mobile Card View -->
                <div class="d-lg-none mt-3">
                    @forelse ($certificates as $certificate)
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-body">

                                <!-- Header -->
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold mb-1">
                                            @if ($certificate->certificate_file)
                                                <a href="{{ asset('storage/' . $certificate->certificate_file) }}"
                                                    target="_blank">
                                                    {{ $certificate->name }}
                                                </a>
                                            @else
                                                {{ $certificate->name }}
                                            @endif
                                        </h6>

                                        <small class="text-muted">
                                            Vessel: {{ $certificate->vessel->name ?? '-' }}
                                        </small>
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        @if ($certificate->isExpired())
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif ($certificate->isExpiringSoon())
                                            <span class="badge bg-warning text-dark">Expiring Soon</span>
                                        @else
                                            <span class="badge bg-success">Valid</span>
                                        @endif
                                    </div>
                                </div>

                                <hr class="my-2">

                                <!-- Dates -->
                                <div class="row small">
                                    <div class="col-6">
                                        <div class="text-muted">Issue Date</div>
                                        <div class="fw-semibold">
                                            {{ $certificate->issue_date->format('d M Y') }}
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="text-muted">Expired Date</div>
                                        <div class="fw-semibold">
                                            {{ $certificate->expiry_date->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="mt-3">
                                    <div class="btn-group w-100" role="group">

                                        @if ($certificate->certificate_file)
                                            <a href="{{ asset('storage/' . $certificate->certificate_file) }}"
                                                target="_blank" class="btn btn-info">
                                                <i class="fas fa-file-pdf"></i> Open
                                            </a>
                                        @endif

                                        <a href="{{ route('vessel-certificates.edit', $certificate) }}"
                                            class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('vessel-certificates.destroy', $certificate) }}"
                                            method="POST" class="d-inline flex-fill" onsubmit="confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger w-100">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>

                    @empty
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center text-muted py-4">
                                No vessel certificates registered yet
                            </div>
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
