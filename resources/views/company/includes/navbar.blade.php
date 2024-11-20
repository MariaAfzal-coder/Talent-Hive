<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid pc-gutter hstack">
        <div class="nav-left hstack gap-1">
            <button class="navbar-toggler d-lg-none me-2 border-0 p-0" type="button" id="sidebarToggle">
                <img src="{{ asset('Studentdashboard/assets/images/icon/menu.svg') }}" alt="Menu Icon" height="30px" width="30px">
            </button>
            <div class="logo d-lg-none me-1">
                <img src="{{ asset('Studentdashboard/assets/images/logo.svg') }}" alt="Logo" width="140" class="img-fluid">
            </div>
        </div>

        <div class="d-flex align-items-center nav-right gap-2 gap-lg-4">

            <div class="icons d-flex align-items-center gap-2">
                <a href=" "><i class="fas fa-bell"></i></a>
                <a href="{{ url('/company/chats') }}"><i class="fas fa-comments"></i></a>
            </div>

            <div class="dropdown profile-dropdown">
                <a class="dropdown-toggle d-flex text-decoration-none" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="viewport">
                    <span class="d-flex flex-column text-end d-none d-sm-flex">
                        <span class="text-md text-dark">{{ $LoggedCompanyInfo->name }}</span>
                        <span class="text-secondary text-sm">Islamabad</span>
                    </span>
                    <img src="{{ $LoggedCompanyInfo->profile_image ? Storage::url($LoggedCompanyInfo->profile_image) : asset('Studentdashboard/assets/images/avatar.jpg') }}" height="40" width="40" alt="User" class="rounded-circle ms-2">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item" href="#">Profile</a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            <li><a class="dropdown-item" href="{{ route('company.profile') }}">View Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('company.makeprofile') }}">Make Profile</a></li>

                            <li><a class="dropdown-item" href="{{ route('company.editprofile') }}">Edit Profile</a></li>
                        </ul>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('company.logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>/* Show the submenu on hover */
.dropdown-submenu:hover .dropdown-menu {
    display: block;
}

/* Adjust positioning */
.dropdown-submenu .dropdown-menu {
    top: 0;
    right: 100%;
    margin-top: 0;
    margin-left: 0;
    display: none;
    position: absolute;
}
</style>