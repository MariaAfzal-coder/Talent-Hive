<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - TalentHive</title>
    <link rel="shortcut icon" href="../Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Inchargedashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Inchargedashboard/assets/css/style.css">
</head>

<body>
    <!-- Dimmed Background -->
    <div class="dim-background" id="dimBackground"></div>


    <!-- Sidebar -->
    @include('incharge.includes.sidebar')


    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('incharge.includes.navbar')
        <!-- Page Content -->
        <div class="container-fluid pc-gutter mt-4">
            <div class="hstack justify-content-between gap-2 mb-3">
                <h1 class="mb-0 fs-4 fw-semibold">Projects</h1>
             
            </div>

            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <div class="row g-3">
                        @foreach($projects as $project)
                        <div class="col-sm-6 col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="hstack justify-content-between gap-2 flex-wrap">
                                        <h3 class="fs-5 mb-0 fw-semibold d-flex align-items-center">
                                        <a href="{{ route('incharge.project.detail', $project->id) }}"
                                   class="event-title text-decoration-none text-dark">{{ $project->title }}</a>
                                   </h3>
                                        <span
                                            class="bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-1 text-sm project-status ms-3">{{ $project->status }}</span>
                                    </div>
                                    <hr>
                                    <p class="project-description text-secondary mb-3 fw-normal">
                                        {{ Str::limit($project->abstract, 200) }}</p>
                                    <div
                                        class="hstack row-gap-3 gap-2 mb-3 align-items-center justify-content-between flex-wrap">
                                        <div class="hstack gap-2">
                                            <img src="../Inchargedashboard/assets/images/icon/hour-glass.svg"
                                                alt="Time">
                                            <span class="text-danger">Ending
                                                {{ \Carbon\Carbon::parse($project->ending_date)->format('F Y') }}</span>
                                        </div>
                                                                           </div>
                                    <div class="hstack row-gap-3 gap-4 flex-wrap justify-content-between">
                                        <span>
                                            Students:<br>
                                            <div class="avatar-stack">
                                            @foreach($project->students as $member) <!-- Assuming $project->students is the correct way to access members -->
            <div class="d-flex align-items-center mb-2">
                <img class="avatar" 
                     src="{{ Storage::url($member->profile_image) }}" 
                     title="{{ $member->name }}" 
                     alt="User Avatar" />
             </div>
        @endforeach
                                            </div>
                                        </span>
                                        <span>Supervised By:<br><span
                                                class="supervisor text-secondary">{{ $project->supervisor ? $project->supervisor->name : 'Unknown' }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination Links -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-left">
                            {{ $projects->links() }}
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Inchargedashboard/assets/js/main.js"></script>
</body>

</html>