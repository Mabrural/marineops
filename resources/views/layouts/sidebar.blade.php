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
                <!-- Company Info -->
                <div class="sidebar-company text-center py-2 mb-2">
                    <p class="mb-0 text-muted" style="font-size: 11px;">Company</p>
                    <h6 class="mb-0 text-dark fw-semibold">
                        PT Global Maritim Nusantara
                    </h6>
                </div>

                <!-- Dashboard -->
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- MASTER DATA -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Master Data</h4>
                </li>

                <li class="nav-item {{ request()->routeIs('companies.*') ? 'active' : '' }}">
                    <a href="{{ route('companies.index') }}">
                        <i class="fas fa-building"></i>
                        <p>Company</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-user-tie"></i>
                        <p>Client</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-anchor"></i>
                        <p>Port</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-ship"></i>
                        <p>Vessel Registry</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-boxes"></i>
                        <p>Cargo</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-calendar-check"></i>
                        <p>Period</p>
                    </a>
                </li>

                <!-- OPERATIONS -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Operations</h4>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-project-diagram"></i>
                        <p>Project</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-route"></i>
                        <p>Voyage</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-users"></i>
                        <p>Crew</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-clock"></i>
                        <p>Timesheet</p>
                    </a>
                </li>

                <!-- MONITORING -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Monitoring</h4>
                </li>

                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-certificate"></i>
                        <p>Certificate Monitoring</p>
                    </a>
                </li>

                <!-- REPORT -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#report">
                        <i class="fas fa-chart-bar"></i>
                        <p>Reports</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="report">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Project Performance Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Voyage Activity Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Vessel Utilization Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Crew Timesheet Report</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- USER ACCESS -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#user">
                        <i class="fas fa-users-cog"></i>
                        <p>User & Access</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">User Management</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Roles & Permissions</span>
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
