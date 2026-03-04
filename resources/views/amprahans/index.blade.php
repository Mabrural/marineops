@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">

            <div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999; width: 350px;"></div>

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <div>
                    <h3 class="fw-bold mb-0">Amprahan List</h3>
                    <p class="text-muted mb-0">Supply & purchase records</p>
                </div>
                <div>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createAmprahanModal">
                        <i class="fas fa-plus me-1"></i> Add Amprahan
                    </button>
                </div>
            </div>

            <!-- FILTER CARD -->
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row g-2 align-items-end">

                        <div class="col-md-4">
                            <label class="form-label small">Search Item</label>
                            <input type="text" id="searchInput" class="form-control" value="{{ request('search') }}"
                                placeholder="Type item, vendor...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small">Vessel</label>
                            <select id="vesselFilter" class="form-select">
                                <option value="">All Vessels</option>
                                @foreach ($vessels as $vessel)
                                    <option value="{{ $vessel->id }}"
                                        {{ request('vessel_id') == $vessel->id ? 'selected' : '' }}>
                                        {{ $vessel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button id="resetFilter" class="btn btn-outline-secondary w-100">
                                Reset
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <style>
                #amprahanTable .table tbody td {
                    padding: 3px 6px !important;
                    line-height: 1.1 !important;
                    vertical-align: middle !important;
                }

                #amprahanTable .table tbody tr {
                    height: 24px !important;
                }
            </style>
            <style>
                /* EXTREME COMPACT MODE (TD ONLY)*/

                /* Jangan ubah header */
                #amprahanTable .table thead th {
                    padding: 0.5rem 0.75rem !important;
                    /* normal bootstrap */
                    line-height: 1.3 !important;
                }

                /* Paksa hanya TD yang super dempet */
                #amprahanTable .table tbody td {
                    padding: 1px 6px !important;
                    line-height: 1 !important;
                    vertical-align: middle !important;
                }

                /* Perkecil tinggi baris body saja */
                #amprahanTable .table tbody tr {
                    height: 20px !important;
                }

                /* Hilangkan spacing tambahan */
                #amprahanTable .table tbody td .badge,
                #amprahanTable .table tbody td i,
                #amprahanTable .table tbody td .btn {
                    margin: 0 !important;
                    padding-top: 1px !important;
                    padding-bottom: 1px !important;
                }
            </style>

            <div id="amprahanTable">

                <div class="card mt-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Vessel</th>
                                        <th>Item</th>
                                        <th class="text-center">Qty</th>
                                        <th>Vendor</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($amprahans as $row)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration + ($amprahans->currentPage() - 1) * $amprahans->perPage() }}
                                            </td>
                                            <td>{{ $row->supply_date->format('d-m-Y') }}</td>
                                            <td>{{ $row->vessel->name ?? '-' }}</td>
                                            <td>{{ $row->item }}</td>
                                            <td class="text-center">
                                                {{ $row->qty }} {{ $row->unit }}
                                            </td>
                                            <td>{{ $row->vendor_name ?? '-' }}</td>
                                            <td class="text-end">
                                                {{ $row->total_price ? number_format($row->total_price, 2) : '-' }}
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary btn-sm editBtn"
                                                        data-id="{{ $row->id }}"
                                                        data-company="{{ $row->company_id }}"
                                                        data-vessel="{{ $row->vessel_id }}"
                                                        data-date="{{ $row->supply_date->format('Y-m-d') }}"
                                                        data-item="{{ $row->item }}"
                                                        data-spec="{{ $row->specification }}"
                                                        data-qty="{{ $row->qty }}" data-unit="{{ $row->unit }}"
                                                        data-vendor="{{ $row->vendor_name }}"
                                                        data-price="{{ $row->unit_price }}" data-bs-toggle="modal"
                                                        data-bs-target="#editAmprahanModal">
                                                        <i class="fas fa-pen"></i>
                                                    </button>

                                                    <form method="POST" action="{{ route('amprahans.destroy', $row) }}"
                                                        onsubmit="return confirm('Delete this data?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4 text-muted">
                                                No amprahan data found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- ================= CREATE AMPRAHAN MODAL ================= -->
                            <div class="modal fade" id="createAmprahanModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('amprahans.store') }}">
                                        @csrf

                                        <!-- Preserve filter -->
                                        <input type="hidden" name="current_search" value="{{ request('search') }}">
                                        <input type="hidden" name="current_vessel_id" value="{{ request('vessel_id') }}">
                                        <input type="hidden" name="current_page" value="{{ request('page') }}">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Amprahan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row g-2">


                                                    <div class="col-md-12">
                                                        <label class="form-label">Vessel <span
                                                                class="text-danger">*</span></label>
                                                        <select name="vessel_id" class="form-select" required>
                                                            <option value="">Select Vessel</option>
                                                            @foreach ($vessels as $vessel)
                                                                <option value="{{ $vessel->id }}">{{ $vessel->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Supply Date <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" name="supply_date" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Item <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="item" class="form-control"
                                                            placeholder="ex. Oli Mesin SAE 40" required>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Specification</label>
                                                        <input type="text" name="specification" class="form-control"
                                                            placeholder="Detail specification: standard, brand, size, packaging, etc.">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Qty <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" name="qty" placeholder="1"
                                                            class="form-control qty-field" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Unit <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="unit" class="form-control"
                                                            placeholder="liter/pcs/kg/unit/dll." required>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Vendor</label>
                                                        <input type="text" name="vendor_name" class="form-control"
                                                            placeholder="ex. PT Marine Supply or etc.">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Unit Price</label>
                                                        <input type="number" step="0.01" name="unit_price"
                                                            placeholder="100000" class="form-control price-field">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Total Price</label>
                                                        <input type="number" step="0.01" name="total_price"
                                                            class="form-control total-field" readonly>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- ================= EDIT AMPRAHAN MODAL ================= -->
                            <div class="modal fade" id="editAmprahanModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" id="editAmprahanForm">
                                        @csrf
                                        @method('PUT')

                                        <!-- Preserve filter -->
                                        <input type="hidden" name="current_search" value="{{ request('search') }}">
                                        <input type="hidden" name="current_vessel_id"
                                            value="{{ request('vessel_id') }}">
                                        <input type="hidden" name="current_page" value="{{ request('page') }}">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Amprahan</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row g-2">

                                                    <div class="col-md-12">
                                                        <label class="form-label">Vessel</label>
                                                        <select name="vessel_id" class="form-select" required>
                                                            @foreach ($vessels as $vessel)
                                                                <option value="{{ $vessel->id }}">{{ $vessel->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Supply Date</label>
                                                        <input type="date" name="supply_date" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Item</label>
                                                        <input type="text" name="item" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Specification</label>
                                                        <input type="text" name="specification" class="form-control">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Qty</label>
                                                        <input type="number" name="qty"
                                                            class="form-control qty-field" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Unit</label>
                                                        <input type="text" name="unit" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Vendor</label>
                                                        <input type="text" name="vendor_name" class="form-control">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Unit Price</label>
                                                        <input type="number" step="0.01" name="unit_price"
                                                            class="form-control price-field">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Total Price</label>
                                                        <input type="number" step="0.01" name="total_price"
                                                            class="form-control total-field" readonly>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $amprahans->links('pagination::bootstrap-5') }}
                </div>

            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function loadAmprahan(pageUrl = null) {

            let search = $('#searchInput').val();
            let vessel = $('#vesselFilter').val();

            let baseUrl = "{{ route('amprahans.index') }}";
            let params = new URLSearchParams();

            if (search) params.append('search', search);
            if (vessel) params.append('vessel_id', vessel);

            if (pageUrl) {
                let page = new URL(pageUrl).searchParams.get('page');
                if (page) params.append('page', page);
            }

            let finalUrl = baseUrl + '?' + params.toString();

            $.get(finalUrl, function(response) {

                let newTable = $(response).find('#amprahanTable').html();
                $('#amprahanTable').html(newTable);

                window.history.pushState({}, '', finalUrl);
            });
        }

        let delayTimer;
        $('#searchInput').on('keyup', function() {
            clearTimeout(delayTimer);
            delayTimer = setTimeout(loadAmprahan, 400);
        });

        $(document).on('change', '#vesselFilter', function() {
            loadAmprahan();
        });

        $('#resetFilter').on('click', function() {
            $('#searchInput').val('');
            $('#vesselFilter').val('');
            loadAmprahan();
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            loadAmprahan($(this).attr('href'));
        });
    </script>
    <script>
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');
            $('#editAmprahanForm').attr('action', '/amprahans/' + id);

            $('#editAmprahanForm select[name="vessel_id"]').val($(this).data('vessel'));
            $('#editAmprahanForm input[name="supply_date"]').val($(this).data('date'));
            $('#editAmprahanForm input[name="item"]').val($(this).data('item'));
            $('#editAmprahanForm input[name="specification"]').val($(this).data('spec'));
            $('#editAmprahanForm input[name="qty"]').val($(this).data('qty'));
            $('#editAmprahanForm input[name="unit"]').val($(this).data('unit'));
            $('#editAmprahanForm input[name="vendor_name"]').val($(this).data('vendor'));
            $('#editAmprahanForm input[name="unit_price"]').val($(this).data('price'));

            let qty = parseFloat($(this).data('qty')) || 0;
            let price = parseFloat($(this).data('price')) || 0;
            $('#editAmprahanForm input[name="total_price"]').val((qty * price).toFixed(2));
        });
    </script>

    <script>
        function calculateTotal(modal) {
            let qty = parseFloat(modal.find('.qty-field').val()) || 0;
            let price = parseFloat(modal.find('.price-field').val()) || 0;
            modal.find('.total-field').val((qty * price).toFixed(2));
        }

        // CREATE modal
        $('#createAmprahanModal').on('input', '.qty-field, .price-field', function() {
            calculateTotal($('#createAmprahanModal'));
        });

        // EDIT modal
        $('#editAmprahanModal').on('input', '.qty-field, .price-field', function() {
            calculateTotal($('#editAmprahanModal'));
        });
    </script>
@endsection
