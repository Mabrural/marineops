<aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/img/marineops/marineops-logo-light.svg') }}" alt="MarineOps">
        </a>
        <button class="btn btn-icon text-white d-lg-none" type="button" data-sidebar-close aria-label="Close navigation"><i class="fas fa-times"></i></button>
    </div>

    <nav class="sidebar-nav" aria-label="Primary navigation">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="fas fa-th-large"></i><span>Dashboard</span></a>

        @if (! Auth::user()->is_platform_admin)
            <p class="nav-label">Master data</p>
            <a class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}" href="{{ route('clients.index') }}"><i class="fas fa-user-tie"></i><span>Clients</span></a>
            <a class="nav-link {{ request()->routeIs('ports.*') ? 'active' : '' }}" href="{{ route('ports.index') }}"><i class="fas fa-anchor"></i><span>Ports</span></a>
            <a class="nav-link {{ request()->routeIs('vessels.*') ? 'active' : '' }}" href="{{ route('vessels.index') }}"><i class="fas fa-ship"></i><span>Vessel Registry</span></a>
            <a class="nav-link {{ request()->routeIs('cargos.*') ? 'active' : '' }}" href="{{ route('cargos.index') }}"><i class="fas fa-box"></i><span>Cargo</span></a>
            <a class="nav-link {{ request()->routeIs('periods.*') ? 'active' : '' }}" href="{{ route('periods.index') }}"><i class="far fa-calendar"></i><span>Periods</span></a>

            <p class="nav-label">Operations</p>
            <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}"><i class="fas fa-project-diagram"></i><span>Projects</span></a>
            <a class="nav-link {{ request()->routeIs('crews.*') ? 'active' : '' }}" href="{{ route('crews.index') }}"><i class="fas fa-users"></i><span>Crew</span></a>
            <a class="nav-link {{ request()->routeIs('assets-management.*') ? 'active' : '' }}" href="{{ route('assets-management.index') }}"><i class="fas fa-cubes"></i><span>Assets</span></a>
            <a class="nav-link {{ request()->routeIs('amprahans.*') ? 'active' : '' }}" href="{{ route('amprahans.index') }}"><i class="fas fa-clipboard-list"></i><span>Amprahan</span></a>

            <p class="nav-label">Monitoring</p>
            <a class="nav-link {{ request()->routeIs('vessel-certificates.*') ? 'active' : '' }}" href="{{ route('vessel-certificates.index') }}"><i class="fas fa-certificate"></i><span>Certificate Monitoring</span></a>
        @else
            <p class="nav-label">Administration</p>
            <a class="nav-link {{ request()->routeIs('backup-restore.*') ? 'active' : '' }}" href="{{ route('backup-restore.index') }}"><i class="fas fa-database"></i><span>Backup & Restore</span></a>
            <a class="nav-link {{ request()->routeIs('document-types.*') ? 'active' : '' }}" href="{{ route('document-types.index') }}"><i class="fas fa-file-alt"></i><span>Document Types</span></a>
            <a class="nav-link {{ request()->routeIs('asset-groups.*') ? 'active' : '' }}" href="{{ route('asset-groups.index') }}"><i class="fas fa-layer-group"></i><span>Asset Groups</span></a>
            <p class="nav-label">User & access</p>
            <a class="nav-link {{ request()->routeIs('companies.*') ? 'active' : '' }}" href="{{ route('companies.index') }}"><i class="far fa-building"></i><span>Companies</span></a>
            <a class="nav-link {{ request()->routeIs('user-management.*') ? 'active' : '' }}" href="{{ route('user-management.index') }}"><i class="fas fa-users-cog"></i><span>User Management</span></a>
            <a class="nav-link {{ request()->routeIs('user-company-assign.*') ? 'active' : '' }}" href="{{ route('user-company-assign.index') }}"><i class="fas fa-link"></i><span>Company Assignment</span></a>
        @endif
    </nav>
</aside>
<div class="sidebar-backdrop" data-sidebar-close></div>
