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
                    <a href="{{ route('assets-management.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>
                        Add Asset
                    </a>
                </div>
            </div>

            <!-- Filter Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row g-2 align-items-end">

                        <div class="col-md-4">
                            <label class="form-label small">Search Asset</label>
                            <input type="text" id="searchInput" class="form-control"
                                placeholder="Type asset name, model, vessel...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small">Vessel</label>
                            <select id="vesselFilter" class="form-select">
                                <option value="">All Vessels</option>
                                @foreach ($vessels as $vessel)
                                    <option value="{{ $vessel->id }}">{{ $vessel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small">Asset Group</label>
                            <select id="groupFilter" class="form-select">
                                <option value="">All Groups</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
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

            <div id="assetTable">

                <!-- Desktop -->
                <div class="card d-none d-lg-block mt-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Asset</th>
                                        <th>Vessel</th>
                                        <th>Group</th>
                                        <th>Qty</th>
                                        <th>Created By / At</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($assets as $asset)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration + ($assets->currentPage() - 1) * $assets->perPage() }}
                                            </td>

                                            <td>
                                                <strong>{{ $asset->name }}</strong><br>
                                                <span class="text-muted small">
                                                    Model: {{ $asset->model ?? '-' }}
                                                </span>
                                            </td>

                                            <td>{{ $asset->vessel->name ?? '-' }}</td>

                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $asset->group->name ?? '-' }}
                                                </span>
                                            </td>

                                            <td>{{ $asset->qty }}</td>

                                            <td>
                                                <div class="small">
                                                    {{ $asset->creator->name ?? '-' }}<br>
                                                    <span class="text-muted">
                                                        {{ $asset->created_at->format('d M Y') }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                <a href="{{ route('assets.show', $asset) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('assets.edit', $asset) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('assets.destroy', $asset) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Delete this asset?')">
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
                                                No assets registered yet
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Mobile -->
                <div class="d-lg-none mt-3">
                    @forelse($assets as $asset)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="mb-1">{{ $asset->name }}</h5>

                                <p class="mb-1 text-muted small">
                                    {{ $asset->vessel->name ?? '-' }} •
                                    {{ $asset->group->name ?? '-' }}
                                </p>

                                <p class="mb-0 text-muted small">
                                    Qty: {{ $asset->qty }}<br>
                                    Model: {{ $asset->model ?? '-' }}<br>
                                    Created by {{ $asset->creator->name ?? '-' }}<br>
                                    {{ $asset->created_at->format('d M Y') }}
                                </p>

                                <div class="mt-2 text-end">
                                    <a href="{{ route('assets-management.show', $asset) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('assets-management.edit', $asset) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('assets-management.destroy', $asset) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete this asset?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            No assets available
                        </div>
                    @endforelse
                </div>

                <div class="mt-3">
                    {{ $assets->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>
    <script>
        function loadAssets(url = "{{ route('assets-management.index') }}") {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    search: $('#searchInput').val(),
                    vessel_id: $('#vesselFilter').val(),
                    asset_group_id: $('#groupFilter').val()
                },
                success: function(response) {
                    const newTable = $(response).find('#assetTable').html();
                    $('#assetTable').html(newTable);
                }
            });
        }

        $('#searchInput').on('keyup', function() {
            clearTimeout(this.delay);
            this.delay = setTimeout(loadAssets, 400);
        });

        $('#vesselFilter, #groupFilter').on('change', function() {
            loadAssets();
        });

        $('#resetFilter').on('click', function() {
            $('#searchInput').val('');
            $('#vesselFilter').val('');
            $('#groupFilter').val('');
            loadAssets();
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            loadAssets($(this).attr('href'));
        });
    </script>
@endsection
