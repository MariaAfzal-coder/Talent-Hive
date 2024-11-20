<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile - TalentHive</title>
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

    <style>
    .location-text {
        font-size: 0.60rem !important;
        /* Use !important to override any other styles */
        width: 550px;
        /* Set width */
        height: auto;
        /* Adjust height as needed */
        overflow: hidden;
        /* Hide overflow if the text is too long */
        white-space: nowrap;
        /* Prevent text from wrapping */
        text-overflow: ellipsis;
        /* Add ellipsis if text is too long */
        margin-bottom: 0;
    }
    </style>
    <style>
    .form-label {
        font-weight: bold;
        /* Make labels bold */
        color: #333;
        /* Darker color for better visibility */
        margin-bottom: 0.5rem;
        /* Space between label and input */
    }

    .form-control {
        border: 1px solid #ced4da;
        /* Standard border */
        border-radius: 0.375rem;
        /* Rounded corners */
        transition: border-color 0.2s;
        /* Smooth border color transition */
    }

    .form-control:focus {
        border-color: #007bff;
        /* Highlight border on focus */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        /* Focus shadow */
    }

    .btn-primary {
        background-color: #007bff;
        /* Primary button color */
        border: none;
        /* Remove default border */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Darker shade on hover */
    }

    .technology-container {
        position: relative;
        /* Position relative for better styling */
        margin-top: 0.5rem;
        /* Space above technologies */
    }

    .technology-container input {
        margin-top: 0.5rem;
        /* Space between technology inputs */
    }

    .profile-image-preview {
        width: 100px;
        /* Set a fixed width for image preview */
        border-radius: 0.5rem;
        /* Rounded corners */
        margin-top: 0.5rem;
        /* Space above image */
    }

    .add-tech-btn {
        color: #007bff;
        /* Primary button color */
        text-decoration: underline;
        /* Underline for emphasis */
        cursor: pointer;
        /* Pointer cursor for better UX */
    }

    .add-tech-btn:hover {
        color: #0056b3;
        /* Darker shade on hover */
    }
    </style>
</head>

<body>
    <!-- Dimmed Background -->
    <div class="dim-background" id="dimBackground"></div>

    <!-- Sidebar -->
    @include('company.includes.sidebar')

    <!-- Main Content -->
    <div class="content-wrapper">

        <!-- Top Navbar -->
        @include('company.includes.navbar')

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





     
    <div id="editSection">
    <h2>Make Profile</h2>

         <div class="row g-3">
            <div class="col-md-10 col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body p-3">
                        <form action="{{ route('company.profile.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input required type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $LoggedCompanyInfo->name) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input required type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', $LoggedCompanyInfo->email) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="phonenumber" class="form-label">Phone Number</label>
                                        <input required type="tel" class="form-control" id="phonenumber" name="phonenumber"
                                            value="{{ old('phonenumber', $LoggedCompanyInfo->phonenumber) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="nationaltaxnumber" class="form-label">National Tax
                                            Number</label>
                                        <input required type="text" class="form-control" id="nationaltaxnumber"
                                            name="nationaltaxnumber"
                                            value="{{ old('nationaltaxnumber', $LoggedCompanyInfo->nationaltaxnumber) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input  required type="text" class="form-control" id="location" name="location"
                                            value="{{ old('location', $LoggedCompanyInfo->location) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="technologies" class="form-label">Technologies</label>
                                        <button type="button" id="addTechnology" class="btn btn-link">+</button>
                                        <div id="technologyContainer">
                                            @if (!empty($LoggedCompanyInfo->technologies) &&
                                            is_array(json_decode($LoggedCompanyInfo->technologies)))
                                            @foreach (json_decode($LoggedCompanyInfo->technologies) as $technology)
                                            <input required type="text" class="form-control mt-2" name="technologies[]"
                                                placeholder="Technology Used"
                                                value="{{ old('technologies[]', $technology) }}">
                                            @endforeach
                                            @endif
                                            <input required type="text" class="form-control mt-2" name="technologies[]"
                                                placeholder="Technology Used" value="">
                                        </div>
                                    </div>
                                </div>

                                <script>
                                document.getElementById('addTechnology').addEventListener('click', function() {
                                    const newInput = document.createElement('input');
                                    newInput.type = 'text';
                                    newInput.className = 'form-control mt-2';
                                    newInput.name = 'technologies[]';
                                    newInput.placeholder = 'Technology Used';
                                    document.getElementById('technologyContainer').appendChild(newInput);
                                });
                                </script>



                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="profileImageUpload" class="form-label">Profile Image</label>
                                        <input required type="file" class="form-control" id="profileImageUpload"
                                            name="profile_image" accept="image/*">
                                        @if($LoggedCompanyInfo->profile_image)
                                        <img id="profileImagePreview"
                                            src="{{ Storage::url($LoggedCompanyInfo->profile_image) }}"
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

    <script>
    document.getElementById('viewBtn').addEventListener('click', function() {
        document.getElementById('editSection').style.display = 'none'; // Hide edit section
        document.getElementById('viewSection').style.display = 'block'; // Show view section
    });

    document.getElementById('editBtn').addEventListener('click', function() {
        document.getElementById('viewSection').style.display = 'none'; // Hide view section
        document.getElementById('editSection').style.display = 'block'; // Show edit section
    });
    </script>

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


    <script>
    function addTechnology() {
        const container = document.getElementById('technologiesContainer');

        // Create a new input element
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.className = 'form-control mb-2';
        newInput.name = 'technologies[]'; // This ensures all inputs are grouped as an array
        newInput.placeholder = 'Add technology';

        // Append the new input to the container
        container.appendChild(newInput);
    }
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