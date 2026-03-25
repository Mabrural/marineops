@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <!-- Alert Notification Container -->
            <div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999; width: 350px;"></div>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <div>
                    <h3 class="fw-bold mb-0">Registered cargos</h3>
                    <p class="text-muted mb-0">
                        Cargos registered for this company
                    </p>
                </div>
                <div>
                    <a href="{{ route('cargos.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>
                        Add Cargo
                    </a>
                </div>
            </div>
            <style>
                /* EXTREME COMPACT MODE (TD ONLY)*/

                /* Jangan ubah header */
                #cargoTable .table thead th {
                    padding: 0.5rem 0.75rem !important;
                    /* normal bootstrap */
                    line-height: 1.3 !important;
                }

                /* Paksa hanya TD yang super dempet */
                #cargoTable .table tbody td {
                    padding: 1px 6px !important;
                    line-height: 1 !important;
                    vertical-align: middle !important;
                }

                /* Perkecil tinggi baris body saja */
                #cargoTable .table tbody tr {
                    height: 20px !important;
                }

                /* Hilangkan spacing tambahan */
                #cargoTable .table tbody td .badge,
                #cargoTable .table tbody td i,
                #cargoTable .table tbody td .btn {
                    margin: 0 !important;
                    padding-top: 1px !important;
                    padding-bottom: 1px !important;
                }
            </style>

            <div id="cargoTable">
                <!-- Desktop Table -->
                <div class="card d-none d-lg-block mt-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Cargo Name</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cargos as $cargo)
                                        <tr>
                                            <td>{{ $loop->iteration + ($cargos->currentPage() - 1) * $cargos->perPage() }}
                                            </td>

                                            <td>
                                                <strong>{{ $cargo->name }}</strong>
                                            </td>

                                            <td>
                                                <a href="{{ route('cargos.edit', $cargo) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('cargos.destroy', $cargo) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Delete this company?')">
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
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                No cargos registered yet
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
                    @forelse ($cargos as $cargo)
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-body">

                                <!-- Header -->
                                <div class="d-flex justify-content-between align-items-start">

                                    <div>
                                        <h6 class="fw-bold mb-1">
                                            <i class="fas fa-box text-primary me-2"></i>
                                            {{ $cargo->name }}
                                        </h6>

                                        <small class="text-muted">
                                            Cargo Item
                                        </small>
                                    </div>

                                </div>

                                <hr class="my-2">

                                <!-- Actions -->
                                <div class="mt-2">
                                    <div class="btn-group w-100" role="group">

                                        <a href="{{ route('cargos.edit', $cargo) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('cargos.destroy', $cargo) }}" method="POST"
                                            class="d-inline flex-fill" onsubmit="return confirm('Delete this cargo?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger w-100">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>

                    @empty
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center text-muted py-4">

                                <i class="fas fa-box fa-2x mb-2"></i>

                                <div class="fw-semibold">
                                    No cargos available
                                </div>

                                <small>
                                    Please add a cargo to get started
                                </small>

                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $cargos->links('pagination::bootstrap-5') }}
                </div>
            </div>


        </div>
    </div>

    <!-- SweetAlert for Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Show alerts from session
        @if (session('success'))
            showAlert('success', '{{ session('success') }}');
        @endif

        @if (session('error'))
            showAlert('error', '{{ session('error') }}');
        @endif

        @if ($errors->any())
            showAlert('error', '{{ $errors->first() }}');
        @endif

        // Custom alert function
        function showAlert(type, message) {
            const alertContainer = document.getElementById('alertContainer');
            const alertId = 'alert-' + Date.now();

            const alertEl = document.createElement('div');
            alertEl.id = alertId;
            alertEl.className = `alert alert-${type} alert-dismissible fade show shadow-sm`;
            alertEl.role = 'alert';
            alertEl.style.cssText = `
                position: relative;
                overflow: hidden;
                border: none;
                border-left: 4px solid ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#ffc107'};
                animation: slideIn 0.3s ease-out forwards;
                margin-bottom: 10px;
            `;

            // Add icon based on type
            let icon = '';
            if (type === 'success') {
                icon = '<i class="fas fa-check-circle me-2"></i>';
            } else if (type === 'error') {
                icon = '<i class="fas fa-exclamation-circle me-2"></i>';
            } else {
                icon = '<i class="fas fa-info-circle me-2"></i>';
            }

            alertEl.innerHTML = `
                <div class="d-flex align-items-center">
                    <div style="font-size: 1.5rem; color: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#ffc107'};">
                        ${icon}
                    </div>
                    <div>
                        <strong>${type.charAt(0).toUpperCase() + type.slice(1)}!</strong> ${message}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.7rem;"></button>
            `;

            alertContainer.appendChild(alertEl);

            // Auto dismiss after 5 seconds
            setTimeout(() => {
                const alert = document.getElementById(alertId);
                if (alert) {
                    alert.style.animation = 'fadeOut 0.3s ease-out forwards';
                    setTimeout(() => alert.remove(), 300);
                }
            }, 5000);
        }

        // Custom delete confirmation
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    popup: 'animated bounceIn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes fadeOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            .alert {
                transition: all 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    </script>
@endsection
