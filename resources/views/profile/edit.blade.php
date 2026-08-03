@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="page-header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <p class="eyebrow mb-1">Account settings</p>
                    <h4 class="page-title mb-1">My Profile</h4>
                    <p class="text-muted mb-0">Keep your personal information and password up to date.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary"><i class="fas fa-arrow-left me-1"></i>Back to Dashboard</a>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex align-items-center gap-3">
                                <span class="user-avatar flex-shrink-0">{{ strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                                <div>
                                    <div class="card-title mb-1">Profile information</div>
                                    <p class="text-muted small mb-0">Name and email used for your MarineOps account.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="card-title mb-1">Password</div>
                            <p class="text-muted small mb-0">Use a strong password that you do not use elsewhere.</p>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
