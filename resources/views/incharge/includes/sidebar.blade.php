<!-- Sidebar -->
<div class="sidebar vstack justify-content-between">
    <div>
        <div class="logo p-0">
            <img src="{{ asset('Inchargedashboard/assets/images/logo.png') }}" alt="Logo" width="35" class="img-fluid">
            <span class="text-xl fw-semibold">Talent Hive</span>
        </div>

        <ul class="nav flex-column mt-2 pb-5">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('incharge.dashboard') ? 'active' : '' }}" href="{{ route('incharge.dashboard') }}">
                    <img src="{{ asset('Inchargedashboard/assets/images/inc/62b4c5fb2654ca2eebd9c32b_Dashboard-Icon-3.png') }}" height="24" width="24" class="inject-svg" alt="Project Dashboard"> Dashboard
                </a>
            </li>

            <ul class="nav flex-column mt-2 pb-5">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('incharge.projects') ? 'active' : '' }}" href="{{ route('incharge.projects') }}">
                        <img src="{{ asset('Inchargedashboard/assets/images/inc/project dashboard.png') }}" height="24" width="24" class="inject-svg" alt="Project Dashboard"> Project Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('incharge/events') ? 'active' : '' }}" href="{{ route('incharge.events') }}">
                        <img src="{{ asset('Inchargedashboard/assets/images/inc/event management.png') }}" height="24" width="24" class="inject-svg" alt="event-management"> Event Management
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('incharge/attendence') ? 'active' : '' }}" href="{{ route('incharge.attendence') }}">
                        <img src="{{ asset('Inchargedashboard/assets/images/inc/attendance management.png') }}" class="inject-svg" alt="attendance"> Attendance Management
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('incharge.statustracking') ? 'active' : '' }}" href="{{ route('incharge.statustracking') }}">
                        <img src="{{ asset('Inchargedashboard/assets/images/inc/status tracking.png') }}" class="inject-svg" alt="Status"> Status Tracking
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('incharge.certificaiton') ? 'active' : '' }}" href="{{ route('incharge.certificaiton') }}">
                        <img src="{{ asset('Inchargedashboard/assets/images/inc/electronic certification.png') }}" class="inject-svg" alt="Electronic Certification"> Electronic Certification
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('incharge.report') ? 'active' : '' }}" href="{{ route('incharge.report') }}">
                        <img src="{{ asset('Inchargedashboard/assets/images/inc/fullreport.png') }}" class="inject-svg" alt="Full Report"> Full Report
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
