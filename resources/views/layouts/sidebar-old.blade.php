<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/marineops/marine-ops-text-light.svg') }}" alt="navbar brand"
                    class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-building"></i>
                        <p>Company Management</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-boxes"></i>
                        <p>Cargo Management</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-calendar-check"></i>
                        <p>Period Management</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>Client Management</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-anchor"></i>
                        <p>Port Management</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-ship"></i>
                        <p>Vessel Registry</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-users"></i>
                        <p>Crew Management</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-certificate"></i>
                        <p>Certificate Monitoring</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-project-diagram"></i>
                        <p>Project Management</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-route"></i>
                        <p>Voyage Management</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('period-list.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-clock"></i>
                        <p>Timesheet Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#report">
                        <i class="fas fa-chart-bar"></i>
                        <p>Report & Analytics</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="report">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">Project Summary Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <span class="sub-item">Vessel Activity Chart</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/gridsystem.html">
                                    <span class="sub-item">Grid System</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/panels.html">
                                    <span class="sub-item">Panels</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#user">
                        <i class="fas fa-users-cog"></i>
                        <p>User Access</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">User Management</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <span class="sub-item">Role & Permissions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->