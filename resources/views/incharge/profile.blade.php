<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incharge Profile - TalentHive</title>
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
                <h2>View Profile</h2>
                <div class="row g-3">
                    <div class="col-md-10 col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body p-3">
                                <p><strong>Name:</strong> {{ $LoggedInchargeInfo->name }}</p>
                                <p><strong>Email:</strong> {{ $LoggedInchargeInfo->email }}</p>
                                <p><strong>Phone Number:</strong> {{ $LoggedInchargeInfo->department }}</p>
                                @if($LoggedInchargeInfo->profile_image)
                                <img src="{{ Storage::url($LoggedInchargeInfo->profile_image) }}" alt="Profile Image"
                                    width="100" />
                                @endif
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
    <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Inchargedashboard/assets/js/main.js"></script>


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