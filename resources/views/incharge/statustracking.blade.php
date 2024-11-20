<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Tracking - TalentHive</title>
    <link rel="shortcut icon" href="../Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="../Inchargedashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Inchargedashboard/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Inchargedashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Inchargedashboard/assets/css/style.css">
</head>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #fdfcfc;
    margin: 0;
    padding: 0;
}

.content-wrapper {
    padding: 20px;
}

.progress-tracking {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.student-progress,
.interaction-status {
    background-color: white;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 48%;
    margin-bottom: 20px;
}

.student-card,
.interaction-card {
    margin-bottom: 1rem;
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.student-card h3,
.interaction-card h3 {
    margin: 0 0 0.5rem;
}

.progress-bar {
    background-color: #e0e0e0;
    border-radius: 5px;
    overflow: hidden;
    margin: 0.5rem 0;
}

.progress {
    background-color: #28a745;
    height: 20px;
    border-radius: 5px;
    transition: width 0.5s ease;
}

button {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-right: 0.5rem;
}

button:hover {
    background-color: #0056b3;
}

h2 {
    border-bottom: 2px solid #007BFF;
    padding-bottom: 0.5rem;
}

.hidden {
    display: none;
}

h6 {
    border-bottom: 2px solid #007BFF;
    padding-bottom: 0.5rem;
}

.center {
    text-align: center;
    /* margin-top: 0px; Adjust as needed */
}

.status-tracking {
    text-align: center;
    margin-top: 20px;
}
</style>

<body>
    @include('incharge.includes.sidebar')


    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('incharge.includes.navbar')

        <!-- Page Content -->
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="hero-wrap" style="background-image: url('assets/images/bg_1.jpg');"
                        data-stellar-background-ratio="0.5">
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="row no-gutters slider-text align-items-center justify-content-center">
                                <div class="col-md-8 text-center mt-5 pt-md-5">
                                    <h1 class="mb-4">Status Tracking</h1>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-5">
                        <div class="row">
                            @foreach ($projects as $event)
                            <div class="col-12 mb-4">

                                <hp>{{ $event->event_name }}</p> <!-- Display the event name -->
                                    <p>Session: {{ $event->session }}</p>
                                    <hr class="blue-line"> <!-- Blue horizontal line -->

                                    <div class="row">
                                        @foreach ($event->projects as $project)
                                        <div class="col-md-6 mb-4">
                                            <!-- Use col-md-6 to have two columns per row -->
                                            <div class="project-card">
                                                <!-- Optional: Wrap each project in a card for better styling -->
                                                <h3>{{ $project->title }}</h3>
                                                <p>Status: <strong>{{ $project->status }}</strong></p>
                                                <div class="progress-bar">
                                                    <div class="progress" style="width: {{ $project->progress }}%;">
                                                    </div>
                                                </div>
                                                <p>Progress: <span
                                                        class="progress-value">{{ $project->progress }}%</span></p>

                                                <p>Students:</p>
                                                <div class="student-names">
                                                    @foreach ($project->students as $student)
                                                    <img src="{{ $student->profile_image ? Storage::url($student->profile_image) : asset('Studentdashboard/assets/images/avatar.jpg') }}"
                                                        height="30" width="30" class="rounded-circle ms-2">
                                                    {{ $student->name }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <style>
    .blue-line {
        border: 0;
        /* Remove default border */
        height: 2px;
        /* Height of the line */
        background-color: #007BFF;
        margin: 10px 0;
        /* Space above and below the line */
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


    <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/svg-injector.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Inchargedashboard/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>




    <!-- Bootstrap JS and Popper.js -->
    <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Inchargedashboard/assets/js/main.js"></script>
</body>

</html>