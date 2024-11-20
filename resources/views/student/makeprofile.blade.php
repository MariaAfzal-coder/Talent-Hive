<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - TalentHive</title>
    <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Studentdashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Studentdashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Studentdashboard/assets/css/style.css">
    <style>
    .icons {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .icons i {
        font-size: 1.5em;
        color: rgb(15, 114, 228);
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .icons i:hover {
        color: #1eeeb0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-info img {
        border-radius: 50%;
    }
    </style>
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

             

             
            <div id="editSection"  >
            <h2>Make Profile</h2>

                 <div class="row g-3">
                    <div class="col-md-10 col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body p-3">
                                <form action="{{ route('student.profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input required type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $LoggedStudentInfo->name) }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input  required type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $LoggedStudentInfo->email) }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="sapid" class="form-label">SAP ID</label>
                                                <input required type="text" class="form-control" id="sapid" name="sap_id"
                                                    value="{{ old('sapid', $LoggedStudentInfo->sapid) }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input required type="tel" class="form-control" id="phone" name="phone"
                                                    value="{{ old('phone', $LoggedStudentInfo->phone) }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="cgpa" class="form-label">CGPA</label>
                                                <input required type="text" class="form-control" id="cgpa" name="cgpa"
                                                    value="{{ old('cgpa', $LoggedStudentInfo->cgpa) }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="sdp" class="form-label">SDP</label>
                                                <select class="form-select" id="sdp" name="sdp">
                                                    <option required value="Part-1"
                                                        {{ $LoggedStudentInfo->sdp == 'Part-1' ? 'selected' : '' }}>
                                                        Part-1</option>
                                                    <option  required value="Part-2"
                                                        {{ $LoggedStudentInfo->sdp == 'Part-2' ? 'selected' : '' }}>
                                                        Part-2</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="department" class="form-label">Department</label>
                                                <select  required class="form-select" id="department" name="department">
                                                    <option required value="Software Engineering"
                                                        {{ $LoggedStudentInfo->department == 'Software Engineering' ? 'selected' : '' }}>
                                                        Software Engineering</option>
                                                    <option  required value="Computer Science"
                                                        {{ $LoggedStudentInfo->department == 'Computer Science' ? 'selected' : '' }}>
                                                        Computer Science</option>
                                                    <option required value="Computer Arts"
                                                        {{ $LoggedStudentInfo->department == 'Computer Arts' ? 'selected' : '' }}>
                                                        Computer Arts</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="profileImageUpload" class="form-label">Profile Image</label>
                                                <input required type="file" class="form-control" id="profileImageUpload"
                                                    name="profile_image" accept="image/*"
                                                    onchange="previewImage(event)">
                                                @if($LoggedStudentInfo->profile_image)
                                                <img id="profileImagePreview"
                                                    src="{{ Storage::url($LoggedStudentInfo->profile_image) }}"
                                                    alt="Profile Image" width="100" class="mt-2" />
                                                @else
                                                <p id="profileImagePlaceholder" class="mt-2">Add Image and Update</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                                </form>
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