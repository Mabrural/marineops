@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <!-- Alert Notification Container -->
            <div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999; width: 350px;"></div>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <div>
                    <h3 class="fw-bold mb-0">Document Types</h3>
                    <p class="text-muted mb-0">
                        Manage your document type references
                    </p>
                </div>
                <div>
                    <a href="{{ route('document-types.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>
                        Add Document Type
                    </a>
                </div>
            </div>

            {{-- Tabs --}}
            <ul class="nav nav-tabs mt-3" id="documentTypeTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link" data-type="time_charter" type="button">
                        Time Charter
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-type="freight_charter" type="button">
                        Freight Charter
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-type="shipping_agency" type="button">
                        Shipping Agency
                    </button>
                </li>
            </ul>

            <!-- Desktop Table -->
            <div class="card d-none d-lg-block mt-3">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Document Name</th>
                                    <th>Document Type</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documentTypes as $documentType)
                                    <tr data-type="{{ $documentType->type }}">
                                        <td class="text-center row-number"></td>
                                        <td><strong>{{ $documentType->name }}</strong></td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ str_replace('_', ' ', ucfirst($documentType->type)) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('document-types.edit', $documentType) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('document-types.destroy', $documentType) }}"
                                                    method="POST" onsubmit="return confirm('Delete this document type?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            No documents registered yet
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
                @forelse ($documentTypes as $documentType)
                    <div class="card mb-2 shadow-sm document-card" data-type="{{ $documentType->type }}">
                        <div class="card-body py-2 px-3">

                            <!-- Top row: title + badge -->
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <div class="fw-semibold text-truncate pe-2">
                                    {{ $documentType->name }}
                                </div>

                                <span class="badge bg-light text-dark border text-capitalize">
                                    {{ str_replace('_', ' ', $documentType->type) }}
                                </span>
                            </div>

                            <!-- Divider -->
                            <div class="border-top my-2"></div>

                            <!-- Bottom row: actions -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('document-types.edit', $documentType) }}"
                                    class="btn btn-outline-warning btn-sm px-3" title="Edit">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>

                                <form action="{{ route('document-types.destroy', $documentType) }}" method="POST"
                                    onsubmit="return confirm('Delete this document type?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm px-3" title="Delete">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        No documents available
                    </div>
                @endforelse
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('#documentTypeTabs .nav-link');
            const rows = document.querySelectorAll('tbody tr[data-type]');
            const cards = document.querySelectorAll('.document-card');

            const STORAGE_KEY = 'activeDocumentTypeTab';

            function filterByType(type) {
                let counter = 1;

                // Desktop table
                rows.forEach(row => {
                    if (row.dataset.type === type) {
                        row.style.display = '';
                        const numberCell = row.querySelector('.row-number');
                        if (numberCell) {
                            numberCell.textContent = counter++;
                        }
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Mobile cards
                let mobileCounter = 1;
                cards.forEach(card => {
                    if (card.dataset.type === type) {
                        card.style.display = '';
                        const badge = card.querySelector('.mobile-number');
                        if (badge) {
                            badge.textContent = mobileCounter++;
                        }
                    } else {
                        card.style.display = 'none';
                    }
                });

                localStorage.setItem(STORAGE_KEY, type);
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    filterByType(this.dataset.type);
                });
            });

            // Restore last active tab
            const savedType = localStorage.getItem(STORAGE_KEY) || 'time_charter';
            const activeTab = document.querySelector(`#documentTypeTabs [data-type="${savedType}"]`);

            if (activeTab) {
                activeTab.classList.add('active');
                filterByType(savedType);
            }
        });
    </script>
@endsection
