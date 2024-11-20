<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Home - TalentHive</title>
    <link rel="shortcut icon" href="../Companydashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Companydashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Companydashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Companydashboard/assets/css/style.css">

    <!-- Include SweetAlert from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1 class="mb-3 fs-4 fw-semibold">Hiring Candidates</h1>

            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <div class="row g-3 justify-content-between">
                    <div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-secondary">Candidate</th>
                    <th scope="col" class="text-secondary">Skills</th>
                    <th scope="col" class="text-secondary">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($interviews as $interview)
                    <tr>
                        <td>{{ $interview->student->name }}</td> <!-- Display candidate name -->
                        <td style="width: 200px;">
                                                @if(isset($interview->student->cv) &&
                                                isset($interview->student->cv->skills))
                                                {{ implode(', ', json_decode($interview->student->cv->skills, true)) }}
                                                @else
                                                <span>No skills listed</span>
                                                @endif
                                            </td>

                        <td>Interview Pending</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- <div class="col-md-4">
    <h5 class="mb-3 fw-semibold">Suggested Projects</h5>
    <div class="suggested-projects">
        @foreach($projects as $project)
            <a href="{{ route('company.project.detail', $project->id) }}" class="d-flex gap-2 align-items-center mb-3 text-decoration-none text-dark">
                <img src="{{ asset('storage/' . $project->image) }}" class="rounded-circle" width="35" height="35" alt="Logo">
                <h5 class="mb-1 fs-6">{{ $project->title }}</h5>
            </a>
        @endforeach
    </div>
</div> -->

                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script>
    // Function to show SweetAlert if there's a success message (optional)
    function showSuccessMessage() {
        const successMessage = document.querySelector('meta[name="success-message"]');
        if (successMessage) {
            Swal.fire({
                title: 'Success!',
                text: successMessage.content,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }
    }

    // Function to show SweetAlert if there's an error message (optional)
    function showErrorMessage() {
        const errorMessage = document.querySelector('meta[name="error-message"]');
        if (errorMessage) {
            Swal.fire({
                title: 'Error!',
                text: errorMessage.content,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    }

    // Call the functions to display the messages when the page loads (optional)
    document.addEventListener('DOMContentLoaded', () => {
        showSuccessMessage();
        showErrorMessage();
    });
    </script>

    <!-- Skill and Language Add Buttons -->
    <script>
    document.getElementById('addSkill').addEventListener('click', function() {
        const skillInput = document.createElement('input');
        skillInput.type = 'text';
        skillInput.name = 'skillsUsed[]';
        skillInput.className = 'form-control mb-2';
        skillInput.placeholder = 'Skill Used';
        document.getElementById('skillsContainer').appendChild(skillInput);
    });

    document.getElementById('addLanguage').addEventListener('click', function() {
        const languageInput = document.createElement('input');
        languageInput.type = 'text';
        languageInput.name = 'languageUsed[]';
        languageInput.className = 'form-control mb-2';
        languageInput.placeholder = 'Language Used';
        document.getElementById('languageContainer').appendChild(languageInput);
    });
    </script>

    <!-- SweetAlert Success Notification -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('
            success ') }}',
            confirmButtonText: 'OK'
        });
        @endif
    });
    </script>

    <!-- Bootstrap JS and other JS -->
    <script src="../Companydashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Companydashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Companydashboard/assets/js/main.js"></script>
</body>

</html>