@extends('layouts.main')

@section('container')
<div class="container">
    <div class="page-inner">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center py-3">
            <div>
                <h3 class="fw-bold mb-0">Registered Companies</h3>
                <p class="text-muted mb-0">
                    Companies registered by platform administrators
                </p>
            </div>
            <div>
                <a href="{{ route('companies.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>
                    Add Company
                </a>
            </div>
        </div>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Desktop Table -->
        <div class="card d-none d-lg-block mt-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Company Name</th>
                                <th>Status</th>
                                <th>Created By / At</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                                <tr>
                                    <td>{{ $loop->iteration + ($companies->currentPage() - 1) * $companies->perPage() }}</td>

                                    <td>
                                        <strong>{{ $company->name }}</strong>
                                    </td>

                                    <td>
                                        @if ($company->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="small">
                                            {{ $company->creator->name ?? '-' }}<br>
                                            <span class="text-muted">
                                                {{ $company->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('companies.edit', $company) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('companies.destroy', $company) }}"
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
                                        No companies registered yet
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
            @forelse ($companies as $company)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">{{ $company->name }}</h5>

                                @if ($company->is_active)
                                    <span class="badge bg-success mb-2">Active</span>
                                @else
                                    <span class="badge bg-danger mb-2">Inactive</span>
                                @endif

                                <p class="mb-0 text-muted small">
                                    Created by {{ $company->creator->name ?? '-' }}<br>
                                    {{ $company->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('companies.edit', $company) }}"
                                    class="btn btn-sm btn-warning mb-1">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('companies.destroy', $company) }}"
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
                    No companies available
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $companies->links() }}
        </div>

    </div>
</div>
@endsection
