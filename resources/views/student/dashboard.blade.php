<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home - TalentHive</title>
    <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Studentdashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Studentdashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Studentdashboard/assets/css/style.css">
</head>

<body>
    <!-- Dimmed Background -->
    <div class="dim-background" id="dimBackground"></div>

    <!-- Sidebar -->
    @include('student.includes.sidebar')


    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('student.includes.navbar')
 


  
        <!-- Page Content -->
        <div class="container-fluid pc-gutter mt-4 pb-4">
            <h1 class="mb-3 fs-4 fw-semibold">Home</h1>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-xl fw-semibold flex-shrink-0 mb-3">Project</h6>
                            <div class="project-image">
                                <img src="../Studentdashboard/assets/images/plant-app-project.png" alt="plant app"
                                    class="img-fluid rounded rounded-3">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
    <div class="card h-100">
        <div class="card-body d-flex flex-column">
            <h6 class="text-xl fw-semibold flex-shrink-0 mb-3">CV Creation</h6>
            <div class="hstack gap-2 h-100 align-self-center">
                <a href="{{ url('student/cv') }}" class="btn btn-success-emphasis btn-lg">
                    <img src="./assets/images/icon/plus.svg" alt="" width="24" height="24" class="inject-svg"> 
                    Create a new CV
                </a>
            </div>
        </div>
    </div>
</div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h6 class="text-xl fw-semibold flex-shrink-0 mb-3">Interview Schedule</h6>
                            <div class="hstack gap-2 h-100 align-self-center my-5 py-5">
                                <a href="/student/interview" class="btn btn-success-emphasis btn-lg">Click to see
                                    your schedules interviews</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
    <div class="card h-100">
        <div class="card-body d-flex flex-column">
            <h6 class="text-xl fw-semibold flex-shrink-0 mb-3">Create Project</h6>
            <div class="hstack gap-2 h-100 align-self-center my-5 py-5">
                <a href="{{ url('student/createproject') }}" class="btn btn-success-emphasis btn-lg">
                    <img src="./assets/images/icon/plus.svg" alt="" width="24" height="24" class="inject-svg"> 
                    Create a new Project
                </a>
            </div>
        </div>
    </div>
</div>


            </div>



        </div>

    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Studentdashboard/assets/js/main.js"></script>
</body>

</html>