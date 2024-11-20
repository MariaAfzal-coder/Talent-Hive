<div class="sidebar vstack justify-content-between">
    <div>
        <div class="logo p-0 d-flex align-items-center">
            <img src="{{ asset('Companydashboard/assets/images/logo.png') }}" alt="Logo" width="35" class="img-fluid me-2">
            <h2 class="mb-0">Talent Hive</h2>
        </div>

        <ul class="nav flex-column mt-2 pb-5">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('company/dashboard*') ? 'active' : '' }}" href="{{ route('company.dashboard') }}">
                    <img src="{{ asset('Companydashboard/assets/images/icon/home.svg') }}" height="24" width="24" class="inject-svg" alt="Home"> Home
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('company/profile*') ? 'active' : '' }}" href="{{ route('company.profile') }}">
                    <img src="{{ asset('Companydashboard/assets/images/profile.png') }}" height="24" width="24" class="img-fluid me-2" alt="Profile"> Profile
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('company/project*') ? 'active' : '' }}" href="{{ route('company.project') }}">
                    <img src="{{ asset('Companydashboard/assets/images/project dashboard.png') }}" height="24" width="24" class="img-fluid me-2" alt="Dashboard"> Projects
                </a>
            </li>

            <li class="nav-item">
                <button class="nav-link d-flex justify-content-start w-100" data-bs-toggle="collapse"
                    data-bs-target="#hiring-collapse" aria-expanded="false">
                    <img src="{{ asset('Companydashboard/assets/images/icon/recruitment.png') }}" height="24" width="24" alt="Recruitment"> Recruitment
                </button>
                <div class="collapse" id="hiring-collapse">
                    <ul class="flex-column list-unstyled ms-4 mt-1">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('company/hiringcandidate*') ? 'active' : '' }}"  href="{{ route('company.hiringcandidate') }}">
                                <img src="{{ asset('Companydashboard/assets/images/icon/candidates.png') }}" height="24" width="24" alt="Candidates"> Hiring Candidates
                            </a>
                        </li>
                        <li class="nav-item">
    <a class="nav-link {{ request()->is('company/pendingcandidate*') ? 'active' : '' }}" href="{{ route('company.pendingcandidate') }}">
        <img src="{{ asset('Companydashboard/assets/images/pending.png') }}" height="24" width="24" alt="pending-candidates">Pending Candidates
    </a>
</li>

 
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
