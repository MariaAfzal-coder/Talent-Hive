<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid pc-gutter hstack">
        <div class="nav-left hstack gap-1">
            <button class="navbar-toggler d-lg-none me-2 border-0 p-0" type="button" id="sidebarToggle">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <img src="../Supervisordashboard/assets/images/icon/menu.svg" alt="Menu Icon" height="30px"
                    width="30px">
            </button>
            <!-- <h1 class="mb-0 fs-4 fw-semibold d-none d-lg-block">Dashboard</h1> -->
            <div class="logo d-lg-none me-1">
                <img src="../Supervisordashboard/assets/images/logo.svg" alt="Logo" width="140" class="img-fluid">
            </div>
        </div>
        <div class="d-flex align-items-center nav-right gap-2 gap-lg-4">

        
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <div class="icons d-flex align-items-center gap-2">
                
            </div>

            <div class="dropdown profile-dropdown">
                <a class="dropdown-toggle d-flex text-decoration-none" href="#" role="button" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="viewport">
                    <span class="d-flex flex-column text-end d-none d-sm-flex">
                        <span class="text-md text-dark">{{ $LoggedSupervisorInfo->name }}</span>
                        <span class="text-secondary text-sm">Islamabad</span>
                    </span>
                    <img src="{{ $LoggedSupervisorInfo->profile_image ? Storage::url($LoggedSupervisorInfo->profile_image) : asset('assets/images/avatar.jpg') }}"
                        height="40" width="40" alt="User" class="rounded-circle ms-2">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item" href="#">Profile</a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            <li><a class="dropdown-item" href="/supervisor/profile">View Profile</a></li>
                            <li><a class="dropdown-item" href="/supervisor/makeprofile">Make Profile</a></li>
                            <li><a class="dropdown-item" href="/supervisor/editprofile">Edit Profile</a></li>

                    </li>
                    <li>
                </ul>
                <a class="dropdown-item" href="/supervisor/logout">Logout</a></li>
            </div>
            <!-- <img src="../assets/images/avatar.png" alt="User" class="rounded-circle user-avatar"> -->
        </div>
    </div>
</nav>