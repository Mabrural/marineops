@php
    $isPlatformAdmin = Auth::user()->is_platform_admin;
    $periods = collect();
    $activePeriod = null;

    if (! $isPlatformAdmin && Auth::user()->company) {
        $periods = \App\Models\Period::where('company_id', Auth::user()->company->id)->latest('created_at')->get();
        $activePeriod = $periods->firstWhere('id', session('active_period_id'));
    }
@endphp

<header class="app-header">
    <div class="container-fluid d-flex align-items-center gap-2 h-100">
        <button class="btn btn-icon d-lg-none" type="button" data-sidebar-toggle aria-label="Open navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="app-header-title d-none d-md-block">
            <span class="text-uppercase">Marine Operations</span>
            @if (! $isPlatformAdmin)
                <small>{{ Auth::user()->company?->name ?? 'No company assigned' }}</small>
            @endif
        </div>

        <div class="ms-auto d-flex align-items-center gap-2">
            @if (! $isPlatformAdmin)
                <button type="button" class="period-context" data-bs-toggle="modal" data-bs-target="#periodContextModal">
                    <i class="far fa-calendar-alt"></i>
                    <span>
                        <small>Active period</small>
                        <strong>{{ $activePeriod?->name ?? 'Choose period' }}</strong>
                    </span>
                    <i class="fas fa-pen"></i>
                </button>
            @endif

            <div class="dropdown">
                <button class="user-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="user-avatar">{{ strtoupper(mb_substr(Auth::user()->name ?? 'U', 0, 1)) }}</span>
                    <span class="d-none d-sm-inline text-start">
                        <small>Signed in as</small>
                        <strong>{{ Auth::user()->name ?? '' }}</strong>
                    </span>
                    <i class="fas fa-chevron-down small"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li><h6 class="dropdown-header">{{ Auth::user()->email ?? '' }}</h6></li>
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="far fa-user me-2"></i>Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

@if (! $isPlatformAdmin)
    <div class="modal fade" id="periodContextModal" tabindex="-1" aria-labelledby="periodContextTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <div>
                        <p class="eyebrow mb-1">Working context</p>
                        <h5 class="modal-title" id="periodContextTitle">Choose active period</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small">Projects, voyages, and timesheets are shown for the selected period.</p>
                    <div class="period-list">
                        @forelse ($periods as $period)
                            <form action="{{ route('set.period') }}" method="POST">
                                @csrf
                                <input type="hidden" name="period_id" value="{{ $period->id }}">
                                <button type="submit" class="period-option {{ $period->id == session('active_period_id') ? 'is-active' : '' }}">
                                    <span><strong>{{ $period->name }}</strong><small>Created {{ $period->created_at?->format('d M Y') }}</small></span>
                                    @if ($period->id == session('active_period_id')) <i class="fas fa-check-circle"></i> @endif
                                </button>
                            </form>
                        @empty
                            <p class="text-muted mb-0">No period is available yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
