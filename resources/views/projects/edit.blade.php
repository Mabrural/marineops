@extends('layouts.main')

@section('container')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Edit Project</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projects.index') }}">Projects</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit Project</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Project Information</div>
                    </div>

                    <form method="POST" action="{{ route('projects.update', $project) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">

                                {{-- Period --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Period</label>
                                        <input type="text"
                                            class="form-control"
                                            value="{{ $project->period->name ?? '-' }}"
                                            disabled>
                                    </div>
                                </div>

                                {{-- Client --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Client</label>
                                        <input type="text"
                                            class="form-control"
                                            value="{{ $project->client->name ?? '-' }}"
                                            disabled>
                                    </div>
                                </div>

                                {{-- Project Number --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Project Number</label>
                                        <input type="text"
                                            class="form-control"
                                            value="PRJ-{{ $project->period->name ?? '-' }}-{{ str_pad($project->project_number, 3, '0', STR_PAD_LEFT) }}"
                                            disabled>
                                    </div>
                                </div>

                                {{-- Project Type --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Project Type <span class="text-danger">*</span></label>
                                        <select id="type"
                                            class="form-control @error('type') is-invalid @enderror"
                                            name="type" required>
                                            <option value="time_charter" {{ old('type', $project->type) == 'time_charter' ? 'selected' : '' }}>
                                                Time Charter
                                            </option>
                                            <option value="freight_charter" {{ old('type', $project->type) == 'freight_charter' ? 'selected' : '' }}>
                                                Freight Charter
                                            </option>
                                            <option value="shipping_agency" {{ old('type', $project->type) == 'shipping_agency' ? 'selected' : '' }}>
                                                Shipping Agency
                                            </option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Contract Value --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contract_value">Contract Value</label>
                                        <input type="number"
                                            step="0.01"
                                            min="0"
                                            class="form-control @error('contract_value') is-invalid @enderror"
                                            id="contract_value"
                                            name="contract_value"
                                            value="{{ old('contract_value', $project->contract_value) }}">
                                        @error('contract_value')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select id="status"
                                            class="form-control @error('status') is-invalid @enderror"
                                            name="status" required>
                                            <option value="draft" {{ old('status', $project->status) == 'draft' ? 'selected' : '' }}>
                                                Draft
                                            </option>
                                            <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="finished" {{ old('status', $project->status) == 'finished' ? 'selected' : '' }}>
                                                Finished
                                            </option>
                                            <option value="cancelled" {{ old('status', $project->status) == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Start Date --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date"
                                            class="form-control @error('start_date') is-invalid @enderror"
                                            id="start_date"
                                            name="start_date"
                                            value="{{ old('start_date', $project->start_date) }}">
                                        @error('start_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- End Date --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date"
                                            class="form-control @error('end_date') is-invalid @enderror"
                                            id="end_date"
                                            name="end_date"
                                            value="{{ old('end_date', $project->end_date) }}">
                                        @error('end_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-action">
                            <button type="submit" class="btn btn-primary">
                                Update Project
                            </button>
                            <a href="{{ route('projects.index') }}" class="btn btn-danger">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
