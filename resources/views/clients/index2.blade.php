@extends('layouts.main')

@section('container')
<div class="container">
    <div class="page-inner">
        <!-- Alert Notification Container -->
            <div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999; width: 350px;"></div>

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center py-3">
            <div>
                <h3 class="fw-bold mb-0">Registered clients</h3>
                <p class="text-muted mb-0">
                    Clients registered for this company
                </p>
            </div>
            <div>
                <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>
                    Add Client
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
                                <th>Client Name</th>
                                <th>Address</th>
                                <th>Created By / At</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clients as $client)
                                <tr>
                                    <td>{{ $loop->iteration + ($clients->currentPage() - 1) * $clients->perPage() }}</td>

                                    <td>
                                        <strong>{{ $client->name }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $client->address ?? '-' }}</strong>
                                    </td>


                                    <td>
                                        <div class="small">
                                            {{ $client->creator->name ?? '-' }}<br>
                                            <span class="text-muted">
                                                {{ $client->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('clients.edit', $client) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('clients.destroy', $client) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Delete this company?')">
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
                                        No clients registered yet
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
            @forelse ($clients as $client)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">{{ $client->name }}</h5>


                                <p class="mb-0 text-muted small">
                                    Created by {{ $client->creator->name ?? '-' }}<br>
                                    {{ $client->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('clients.edit', $client) }}"
                                    class="btn btn-sm btn-warning mb-1">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('clients.destroy', $client) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this company?')">
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
                    No clients available
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $clients->links('pagination::bootstrap-5') }}
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
