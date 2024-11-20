<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project - TalentHive</title>
    <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Studentdashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

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
            <h1 class="mb-3 fs-4 fw-semibold">Create Project</h1>

            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <form action="{{ route('student.createproject') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- Include CSRF token for security -->
                        <div class="row gx-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="projectTitle" class="form-label">Title of Project</label>
                                    <input type="text" class="form-control" id="projectTitle" name="title"
                                        placeholder="Enter Project Title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
    <div class="mb-3">
        <label for="projectStatus" class="form-label">Project Status</label>
        <select class="form-select" id="projectStatus" name="status" required>
            <option value="In Progress" selected>In Progress</option>
            <option value="Completed" selected>Completed</option>

        </select>
    </div>
</div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ImageOfProject" class="form-label">Image of Project</label>
                                    <input type="file" class="form-control" id="ImageOfProject" name="image"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ProjectEndingDate" class="form-label">Project Ending Date</label>
                                    <input type="date" class="form-control" id="ProjectEndingDate" name="ending_date"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="ProjectAbstract" class="form-label">Project Abstract</label>
                                    <textarea class="form-control" id="ProjectAbstract" name="abstract" rows="3"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
    <div class="mb-3">
        <label for="languageUsed" class="form-label">Languages Used</label>
        <button type="button" id="addLanguage" class="btn btn-link">+</button>
        <div id="languageContainer">
            <input type="text" class="form-control" name="languages[]" placeholder="Language Used" required>
        </div>
    </div>
</div>

<script>
    // Function to add a new language input box with a remove button
    document.getElementById('addLanguage').addEventListener('click', function() {
        const languageContainer = document.getElementById('languageContainer');
        
        // Create the new input field
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.className = 'form-control mt-2';
        newInput.name = 'languages[]';
        newInput.placeholder = 'Language Used';
        newInput.required = true;

        // Create the remove button
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'btn btn-danger mt-2 ml-2';
        removeButton.textContent = 'Remove';

        // Add event listener to remove the input and button when clicked
        removeButton.addEventListener('click', function() {
            languageContainer.removeChild(newInput);
            languageContainer.removeChild(removeButton);
        });

        // Append the new input and the remove button to the container
        languageContainer.appendChild(newInput);
        languageContainer.appendChild(removeButton);
    });
</script>






<div class="row">
    <!-- Multi-select dropdown (Right Side) -->
    <div class="col-md-12">
        <div class="mb-3">
            <label for="ProjectMembers" class="form-label">Group Members (Students)</label>
            <!-- Multi-select dropdown for students with search -->
            <select class="form-select" id="ProjectMembers" name="members[]"
                multiple="multiple" required>
                <option selected disabled>Select Students</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}"
                        data-img-src="{{ Storage::url($student->profile_image) }}">
                        {{ $student->name }} ({{ $student->sapid }})
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

                            <!-- Include Select2 CSS and JS -->



                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="supervisedBy" class="form-label">Supervised By</label>
                                    <!-- Dropdown for selecting supervisors -->
                                    <select class="form-select" id="supervisedBy" name="supervised_by" required>
                                        <option selected disabled>Select Supervisor</option>
                                        @foreach($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
    <div class="mb-3">
        <label for="projectVideo" class="form-label">Upload Short Video of Project</label>
        <input type="file" class="form-control" id="projectVideo" name="video_file" accept="video/*">
    </div>
</div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>


            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
            </script>

<script>
    $(document).ready(function() {
        // Initialize the Select2 dropdown
        $('#ProjectMembers').select2({
            placeholder: 'Select Students',
            allowClear: true,
            templateResult: formatStudent, // Custom formatting to show image with name
            templateSelection: formatStudentSelection,
            closeOnSelect: false // Keep the dropdown open after selection
        });

        // Format the display of student options (with image)
        function formatStudent(student) {
            if (!student.id) {
                return student.text; // Return the text if no ID
            }

            var imgSrc = $(student.element).data('img-src');
            var studentMarkup = `
                <div class="d-flex align-items-center">
                    <img src="${imgSrc}" style="width: 30px; height: 30px; margin-right: 10px;">
                    <span>${student.text}</span>
                </div>
            `;
            return $(studentMarkup);
        }

        // Format the selected students display (with image)
        function formatStudentSelection(student) {
            if (!student.id) {
                return student.text; // Return the text if no ID
            }
            return student.text; // Return the selected text
        }

        // Keep dropdown open when a student is selected
        $('#ProjectMembers').on('select2:select', function(e) {
            // Prevent dropdown from closing on selection
            $(this).select2('open');
        });
    });
</script>



            <!-- Include jQuery and Select2 JS -->

            <!-- Bootstrap JS and Popper.js -->
            <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
            <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
            <script src="../Studentdashboard/assets/js/main.js"></script>

</body>

</html>