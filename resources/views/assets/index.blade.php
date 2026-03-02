@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">

            <div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999; width: 350px;"></div>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <div>
                    <h3 class="fw-bold mb-0">Asset List</h3>
                    <p class="text-muted mb-0">Assets registered for this company</p>
                </div>
                <div>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createAssetModal">
                        <i class="fas fa-plus me-1"></i>
                        Add Asset
                    </button>

                    <a id="exportPdfBtn" href="{{ route('assets-management.export') }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>
                        Export PDF
                    </a>
                </div>
            </div>





            <!-- Filter Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row g-2 align-items-end">

                        <div class="col-md-4">
                            <label class="form-label small">Search Asset</label>
                            <input type="text" id="searchInput" class="form-control" value="{{ request('search') }}"
                                placeholder="Type asset name, model, vessel...">
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

                        <div class="col-md-3">
                            <label class="form-label small">Asset Group</label>
                            <select id="groupFilter" class="form-select">
                                <option value="">All Groups</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"
                                        {{ request('asset_group_id') == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
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
                /* EXTREME COMPACT MODE (TD ONLY)*/

                /* Jangan ubah header */
                #assetTable .table thead th {
                    padding: 0.5rem 0.75rem !important;
                    /* normal bootstrap */
                    line-height: 1.3 !important;
                }

                /* Paksa hanya TD yang super dempet */
                #assetTable .table tbody td {
                    padding: 1px 6px !important;
                    line-height: 1 !important;
                    vertical-align: middle !important;
                }

                /* Perkecil tinggi baris body saja */
                #assetTable .table tbody tr {
                    height: 20px !important;
                }

                /* Hilangkan spacing tambahan */
                #assetTable .table tbody td .badge,
                #assetTable .table tbody td i,
                #assetTable .table tbody td .btn {
                    margin: 0 !important;
                    padding-top: 1px !important;
                    padding-bottom: 1px !important;
                }
            </style>

            <div id="assetTable">

                <!-- Desktop -->
                <div class="card d-lg-block mt-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Asset</th>
                                        <th>Model/Merk</th>
                                        <th>Vessel</th>
                                        <th>Group</th>
                                        <th class="text-center">Qty</th>
                                        <th>Remarks</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($assets as $asset)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration + ($assets->currentPage() - 1) * $assets->perPage() }}
                                            </td>

                                            <td>
                                                {{ $asset->name ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $asset->model ?? 'N/A' }}
                                            </td>

                                            <td>{{ $asset->vessel->name ?? '-' }}</td>

                                            <td>
                                                {{ $asset->group->name ?? '-' }}
                                            </td>

                                            <td class="text-center">{{ $asset->qty }}</td>

                                            <td>
                                                {{ $asset->remarks ?? '-' }}
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm">

                                                    <button class="btn btn-outline-primary btn-sm editBtn"
                                                        data-id="{{ $asset->id }}"
                                                        data-vessel="{{ $asset->vessel_id }}"
                                                        data-group="{{ $asset->asset_group_id }}"
                                                        data-name="{{ $asset->name }}" data-model="{{ $asset->model }}"
                                                        data-qty="{{ $asset->qty }}"
                                                        data-remarks="{{ $asset->remarks }}" data-bs-toggle="modal"
                                                        data-bs-target="#editAssetModal">
                                                        <i class="fas fa-pen"></i>
                                                    </button>

                                                    <!-- Delete -->
                                                    <form method="POST"
                                                        action="{{ route('assets-management.destroy', $asset) }}"
                                                        onsubmit="return confirm('Delete this asset?')">

                                                        @csrf
                                                        @method('DELETE')

                                                        <input type="hidden" name="current_search"
                                                            value="{{ request('search') }}">
                                                        <input type="hidden" name="current_vessel_id"
                                                            value="{{ request('vessel_id') }}">
                                                        <input type="hidden" name="current_asset_group_id"
                                                            value="{{ request('asset_group_id') }}">
                                                        <input type="hidden" name="current_page"
                                                            value="{{ request('page') }}">

                                                        <button class="btn btn-outline-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>

                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4 text-muted">
                                                No assets registered yet
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- ================= CREATE ASSET MODAL ================= -->
                            <div class="modal fade" id="createAssetModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('assets-management.store') }}">
                                        @csrf

                                        <input type="hidden" name="current_search" value="{{ request('search') }}">
                                        <input type="hidden" name="current_vessel_id" value="{{ request('vessel_id') }}">
                                        <input type="hidden" name="current_asset_group_id"
                                            value="{{ request('asset_group_id') }}">
                                        <input type="hidden" name="current_page" value="{{ request('page') }}">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add New Asset</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">

                                                {{-- Vessel --}}
                                                <div class="mb-3">
                                                    <label class="form-label">Vessel</label>
                                                    <select name="vessel_id" class="form-select" required>
                                                        <option value="">Select Vessel</option>
                                                        @foreach ($vessels as $vessel)
                                                            <option value="{{ $vessel->id }}">
                                                                {{ $vessel->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- Asset Group --}}
                                                <div class="mb-3">
                                                    <label class="form-label">Asset Group</label>
                                                    <select name="asset_group_id" class="form-select" required>
                                                        <option value="">Select Group</option>
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}">
                                                                {{ $group->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- Asset Name --}}
                                                <div class="mb-3">
                                                    <label class="form-label">Asset Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        maxlength="255" required>
                                                </div>

                                                {{-- Model --}}
                                                <div class="mb-3">
                                                    <label class="form-label">Model / Merk</label>
                                                    <input type="text" name="model" class="form-control"
                                                        maxlength="255">
                                                </div>

                                                {{-- Quantity --}}
                                                <div class="mb-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" name="qty" class="form-control"
                                                        min="0" value="1" required>
                                                </div>

                                                {{-- Remarks --}}
                                                <div class="mb-3">
                                                    <label class="form-label">Remarks</label>
                                                    <textarea name="remarks" class="form-control" rows="2"></textarea>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    data-bs-dismiss="modal">
                                                    Cancel
                                                </button>

                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Save Asset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- ================= GLOBAL EDIT MODAL ================= -->
                            <div class="modal fade" id="editAssetModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" id="editAssetForm">
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="current_search" value="{{ request('search') }}">
                                        <input type="hidden" name="current_vessel_id"
                                            value="{{ request('vessel_id') }}">
                                        <input type="hidden" name="current_asset_group_id"
                                            value="{{ request('asset_group_id') }}">
                                        <input type="hidden" name="current_page" value="{{ request('page') }}">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Asset</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label">Vessel</label>
                                                    <select name="vessel_id" class="form-select" required>
                                                        @foreach ($vessels as $vessel)
                                                            <option value="{{ $vessel->id }}">
                                                                {{ $vessel->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Asset Group</label>
                                                    <select name="asset_group_id" class="form-select" required>
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}">
                                                                {{ $group->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Asset Name</label>
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Model</label>
                                                    <input type="text" name="model" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" name="qty" class="form-control"
                                                        min="0" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Remarks</label>
                                                    <textarea name="remarks" class="form-control" rows="2"></textarea>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    data-bs-dismiss="modal">
                                                    Cancel
                                                </button>

                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Update Asset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $assets->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function loadAssets(pageUrl = null) {

            let search = $('#searchInput').val();
            let vessel = $('#vesselFilter').val();
            let group = $('#groupFilter').val();

            let baseUrl = "{{ route('assets-management.index') }}";

            let params = new URLSearchParams();

            if (search) params.append('search', search);
            if (vessel) params.append('vessel_id', vessel);
            if (group) params.append('asset_group_id', group);

            // kalau pagination diklik
            if (pageUrl) {
                let page = new URL(pageUrl).searchParams.get('page');
                if (page) params.append('page', page);
            }

            let finalUrl = baseUrl + '?' + params.toString();

            $.ajax({
                url: finalUrl,
                type: 'GET',
                success: function(response) {

                    let newTable = $(response).find('#assetTable').html();
                    $('#assetTable').html(newTable);

                    // IMPORTANT: update browser URL dengan query lengkap
                    window.history.pushState({}, '', finalUrl);
                }
            });
        }

        // Search delay
        let delayTimer;
        $('#searchInput').on('keyup', function() {
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {
                loadAssets();
            }, 400);
        });

        // Filter change
        $('#vesselFilter, #groupFilter').on('change', function() {
            loadAssets();
        });

        // Reset
        $('#resetFilter').on('click', function() {
            $('#searchInput').val('');
            $('#vesselFilter').val('');
            $('#groupFilter').val('');
            loadAssets();
        });

        // Pagination AJAX
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            loadAssets($(this).attr('href'));
        });

        // ============================
        // DYNAMIC EDIT MODAL
        // ============================

        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');

            $('#editAssetForm').attr('action', '/assets-management/' + id);

            $('#editAssetForm select[name="vessel_id"]').val($(this).data('vessel'));
            $('#editAssetForm select[name="asset_group_id"]').val($(this).data('group'));
            $('#editAssetForm input[name="name"]').val($(this).data('name'));
            $('#editAssetForm input[name="model"]').val($(this).data('model'));
            $('#editAssetForm input[name="qty"]').val($(this).data('qty'));
            $('#editAssetForm textarea[name="remarks"]').val($(this).data('remarks'));
        });
    </script>

    <script>
        $('#exportPdfBtn').on('click', function(e) {
            e.preventDefault();

            let baseUrl = "{{ route('assets-management.export') }}";
            let params = new URLSearchParams();

            let search = $('#searchInput').val();
            let vessel = $('#vesselFilter').val();
            let group = $('#groupFilter').val();

            if (search) params.append('search', search);
            if (vessel) params.append('vessel_id', vessel);
            if (group) params.append('asset_group_id', group);

            let finalUrl = baseUrl + '?' + params.toString();

            window.open(finalUrl, '_blank');
        });
    </script>

    {{-- <script>
        // ==========================
        // AUTO REMEMBER LAST INPUT
        // ==========================

        const createForm = document.querySelector('#createAssetModal form');

        if (createForm) {

            // Load last saved values
            window.addEventListener('DOMContentLoaded', () => {

                const savedData = JSON.parse(localStorage.getItem('lastAssetInput'));

                if (savedData) {
                    Object.keys(savedData).forEach(key => {
                        const field = createForm.querySelector(`[name="${key}"]`);
                        if (field) field.value = savedData[key];
                    });
                }
            });

            // Save on submit
            createForm.addEventListener('submit', function() {

                const formData = new FormData(createForm);
                let dataToSave = {};

                formData.forEach((value, key) => {
                    dataToSave[key] = value;
                });

                localStorage.setItem('lastAssetInput', JSON.stringify(dataToSave));
            });

        }
    </script> --}}
@endsection
