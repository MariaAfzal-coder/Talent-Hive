
<!-- Sidebar -->
<div class="sidebar vstack justify-content-between">
    <div>
        <div class="logo p-0 d-flex align-items-center">
            <img src="{{ asset('Supervisordashboard/assets/images/logo.png') }}" alt="Logo" width="35" class="img-fluid me-2">
            <h2 class="mb-0">Talent Hive</h2>
        </div>
        <ul class="nav flex-column mt-2 pb-5">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('supervisor.dashboard') ? 'active' : '' }}"
                   href="{{ route('supervisor.dashboard') }}">
                    <img src="{{ asset('Supervisordashboard/assets/images/icon/home.svg') }}" height="24" width="24" class="inject-svg" alt="Profile"> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('supervisor.profile') ? 'active' : '' }}"
                   href="{{ route('supervisor.profile') }}">
                    <img src="{{ asset('Supervisordashboard/assets/images/icon/project-dashboard.svg') }}" height="24" width="24" class="inject-svg" alt="Profile"> Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('supervisor.editprofile') ? 'active' : '' }}"
                   href="{{ route('supervisor.editprofile') }}">
                    <img src="{{ asset('Supervisordashboard/assets/images/icon/project-dashboard.svg') }}" height="24" width="24" class="inject-svg" alt="Profile"> Make Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('supervisor.project') ? 'active' : '' }}"
                   href="{{ route('supervisor.project') }}">
                    <img src="{{ asset('Supervisordashboard/assets/images/icon/project-dashboard.svg') }}" height="24" width="24" class="inject-svg" alt="Projects"> Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('supervisor.statustracking') ? 'active' : '' }}"
                   href="{{ route('supervisor.statustracking') }}">
                    <img src="{{ asset('Supervisordashboard/assets/images/icon/check-mark.svg') }}" height="24" width="24" class="inject-svg" alt="Projects"> Status Tracking
                </a>
            </li>
        </ul>
    </div>
</div>