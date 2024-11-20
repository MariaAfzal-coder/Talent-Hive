<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student ViewProfile - TalentHive</title>
    <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Studentdashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Studentdashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Studentdashboard/assets/css/style.css">
</head>


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
            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <br>


            <div id="viewSection">
            <h2>Profile</h2>

    <div class="row g-3">
        <div class="col-md-3 col-lg-5 col-xl-3">
            <div class="card mb-3">
                <div class="card-body text-center text-secondary p-3">
                    <img src="{{ $LoggedStudentInfo->profile_image ? Storage::url($LoggedStudentInfo->profile_image) : 'assets/images/avatar.jpg' }}"
                         alt="User" height="150" width="150"
                         class="rounded-circle mb-3 border border-3 border-success">
                    <h5 class="card-title">{{ $LoggedStudentInfo->name }}</h5>
                    <p class="card-text mb-1">{{ $LoggedStudentInfo->role ?? 'Student' }}</p>
                    <hr>
                    <p class="card-text mb-1">
                        <a href="tel:+{{ $LoggedStudentInfo->phone }}" class="text-decoration-none text-success">{{ $LoggedStudentInfo->phone }}</a>
                    </p>
                    <p class="card-text">
                        <a href="mailto:{{ $LoggedStudentInfo->email }}" class="text-decoration-none text-success">{{ $LoggedStudentInfo->email }}</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-7 col-xl-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="mb-3">
                        <strong>SAP ID:</strong>
                        <p class="text-muted">{{ $LoggedStudentInfo->sapid }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>CGPA:</strong>
                        <p class="text-muted">{{ $LoggedStudentInfo->cgpa }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>SDP:</strong>
                        <p class="text-muted">{{ $LoggedStudentInfo->sdp }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Department:</strong>
                        <p class="text-muted">{{ $LoggedStudentInfo->department }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



        </div>
    </div>

    <script>
    document.getElementById('viewBtn').addEventListener('click', function() {
        document.getElementById('viewSection').style.display = 'block';
        document.getElementById('editSection').style.display = 'none';
    });

    document.getElementById('editBtn').addEventListener('click', function() {
        document.getElementById('viewSection').style.display = 'none';
        document.getElementById('editSection').style.display = 'block';
    });
    </script>


    <!-- Bootstrap JS and Popper.js -->
    <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Studentdashboard/assets/js/main.js"></script>

    <script>
    function previewImage(event) {
        var output = document.getElementById('profileImagePreview');
        output.src = URL.createObjectURL(event.target.files[0]);
    }
    </script>
    <script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profileImagePreview');
            var placeholder = document.getElementById('profileImagePlaceholder');
            output.src = reader.result;
            output.style.display = 'block'; // Show the preview image if hidden
            if (placeholder) {
                placeholder.style.display =
                    'none'; // Hide placeholder text when image is selected
            }
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>

    <script>
    // JavaScript for image upload and preview
    document.getElementById('profileImageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }

        // Sidebar toggle script
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
        });

        // Inject SVGs into the DOM
        SVGInjector(document.querySelectorAll('img.inject-svg'));
    });
    </script>

</html>