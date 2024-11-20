<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incharge EditProfile - TalentHive</title>
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

            

           
            <div id="editSection" >
                <h2>Edit Profile</h2>
                <div class="row g-3">
                    <div class="col-md-10 col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body p-3">
                                <form action="{{ route('incharge.profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $LoggedInchargeInfo->name) }}"  >
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $LoggedInchargeInfo->email) }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input type="tel" class="form-control" id="phone" name="phone"
                                                    value="{{ old('phone', $LoggedInchargeInfo->phone) }}"  >
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="profileImageUpload" class="form-label">Profile Image</label>
                                                <input type="file" class="form-control" id="profileImageUpload"
                                                    name="profile_image" accept="image/*"
                                                    onchange="previewImage(event)">
                                                @if($LoggedInchargeInfo->profile_image)
                                                <img id="profileImagePreview"
                                                    src="{{ Storage::url($LoggedInchargeInfo->profile_image) }}"
                                                    alt="Profile Image" width="100" class="mt-2" />
                                                @else
                                                <p id="profileImagePlaceholder" class="mt-2">Add Image and Update</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                </form>

                                <script>
                                function previewImage(event) {
                                    const output = document.getElementById('profileImagePreview');
                                    if (event.target.files && event.target.files[0]) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            output.src = e.target.result;
                                        }
                                        reader.readAsDataURL(event.target.files[0]);
                                    }
                                }
                                </script>

                                

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