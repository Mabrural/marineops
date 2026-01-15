@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <div>
                    <h3 class="fw-bold mb-0">Registered Companies</h3>
                    <p class="text-muted mb-0">List and manage all companies registered in the system</p>
                </div>
                <div>
                    <a href="" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Add Company
                    </a>
                </div>
            </div>
            <!-- Desktop Table -->
            <div class="card d-none d-lg-block mt-3">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Company Name</th>
                                    <th>Status</th>
                                    <th>Created By/At</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mobile Card List -->
            <div class="d-lg-none mt-3">
                
            </div>
        </div>
    </div>
@endsection
