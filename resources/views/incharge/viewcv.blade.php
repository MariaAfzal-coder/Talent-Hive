<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incharge Home - TalentHive</title>
    <link rel="shortcut icon" href="{{ asset('Inchargedashboard/assets/images/logo.png') }}" type="image/x-icon">
    <link href="{{ asset('Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('Inchargedashboard/assets/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('Inchargedashboard/assets/css/style.css') }}">
    <style>
    
                                     .work-item {
                                        margin-bottom: 1rem;
                                        /* Adds spacing between work items */
                                    }

                                    .work-date {
                                        font-style: italic;
                                        /* Makes the date italic for emphasis */
                                        margin-bottom: 0.5rem;
                                        /* Adds spacing below the date */
                                    }
                                    .education-list {
                                        list-style-type: none;
                                        /* Removes default list bullets */
                                        padding-left: 0;
                                        /* Removes left padding */
                                    }

                                    .education-list li {
                                        margin-bottom: 0.5rem;
                                        /* Adds spacing between items */
                                        font-size: 0.9rem;
                                        /* Adjusts font size */
                                    }
 .cv-container {
    max-width: 900px;
    margin: 40px auto;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.cv-header {
    background-color: #007bff;
    color: white;
    padding: 40px;
    text-align: center;
}

.profile-image {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid white;
    margin-bottom: 20px;
}

.cv-body {
    padding: 40px;
}

.cv-section {
    margin-bottom: 30px;
}

.cv-section h2 {
    color: #007bff;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.contact-info {
    list-style-type: none;
    padding: 0;
}

.contact-info li {
    margin-bottom: 10px;
}

.contact-info i {
    width: 20px;
    margin-right: 10px;
    color: #007bff;
}

.skill-item,
.language-item {
    background-color: #e9ecef;
    border-radius: 20px;
    padding: 5px 15px;
    margin-right: 10px;
    margin-bottom: 10px;
    display: inline-block;
}

.work-item,
.education-item {
    margin-bottom: 20px;
}

.work-item h4,
.education-item h4 {
    color: #343a40;
}

.work-date,
.education-date {
    font-style: italic;
    color: #6c757d;
}

.logo {
    display: flex;
    align-items: center;
}
.loading-message {
    text-align: center;
    font-size: 24px;
    color: #666;
    margin: 20px 0;
}

.result-container {
    text-align: center;
    margin: 20px 0;
}

.score {
    font-size: 36px;
    font-weight: bold;
    color: #28a745; /* Change to your desired color */
}

.logo h2 {
    margin-left: 10px;
    /* Adjust spacing between the logo and text */
    font-size: 1.5rem;
    /* Adjust font size as needed */
    color: #333;
    /* Adjust text color as needed */
}

.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: -100%;
    /* Adjust this value to your needs */
    margin-top: 0;
}

/* Optional: To show the submenu on hover */
.dropdown-submenu:hover .dropdown-menu {
    display: block;
}
</style>
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
        <h1 class="mb-3 fs-4 fw-semibold">
        <a href ="../projects"><i class="fas fa-arrow-left me-2"></i></a>
        CV Preview
    </h1>

            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <div class="d-flex gap-2 justify-content-center mt-3 flex-wrap">
                    <!-- <a href="#" class="btn btn-success" onclick="analyzeCV({{ $student->id }})">CV Analyzer</a> -->
                    <!-- <a href="#" class="btn btn-dark" onclick="openScheduleInterviewModal({{ $student->id }})">Schedule Interview</a> -->
                    </div>
                    <div class="cv-container">
                        <div class="cv-header">
                            <img src="{{ asset('storage/' . $student->cv->image) }}" alt="{{ $student->cv->name }}"
                                class="profile-image">
                            <h1>{{ $student->cv->name }}</h1>
                            <p class="fs-5">{{ $student->cv->profile }}</p>
                        </div>
                        <div class="cv-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="cv-section">
                                        <h2>Contact</h2>
                                        <ul class="contact-info">
                                            <li><i class="fas fa-envelope"></i> {{ $student->cv->email }}</li>
                                            <li><i class="fas fa-phone"></i> {{ $student->cv->phone }}</li>
                                            <li><i class="fas fa-map-marker-alt"></i> {{ $student->cv->address }}</li>
                                        </ul>
                                    </div>
                                    <div class="cv-section">
                                        <h2>Skills</h2>
                                        <div>
                                            @foreach (json_decode($student->cv->skills) as $skill)
                                            <!-- Assuming skills is stored as JSON -->
                                            <span class="skill-item">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="cv-section">
                                        <h2>Languages</h2>
                                        <div>
                                            @foreach (json_decode($student->cv->languages) as $language)
                                            <!-- Assuming languages is stored as JSON -->
                                            <span class="language-item">{{ $language }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="cv-section">
                                        <h2>Profile</h2>
                                        <p>{{ $student->cv->profile }}</p>
                                    </div>
                                    <div class="cv-section">
                                        <h2>Work Experience</h2>
                                                                                                    @php
                                                                    // Split the work experiences by identifying "Company:" as the delimiter
                                                                    $workExperiences = preg_split('/(?<=\.\s)\s*Company:/', $student->cv->work_experience ?? '', -1, PREG_SPLIT_NO_EMPTY);
                                                                @endphp

                                                                @foreach ($workExperiences as $experience)
                                                                    @php
                                                                        // Initialize variables
                                                                        $company = 'Company information not available';
                                                                        $role = 'Role not specified';
                                                                        $responsibilities = 'No responsibilities listed.';

                                                                        // Check for the presence of Company, Role, and Responsibilities
                                                                        if (preg_match('/Company:\s*(.+?)\s*\((\d{4}-\w+)\)/', $experience, $companyMatches)) {
                                                                            $company = trim($companyMatches[1]); // Capture the company name
                                                                        }

                                                                        if (preg_match('/Role:\s*(.+?)\s*Responsibilities:/', $experience, $roleMatches)) {
                                                                            $role = trim($roleMatches[1]); // Capture the role
                                                                        }

                                                                        if (preg_match('/Responsibilities:\s*(.+)/s', $experience, $responsibilitiesMatches)) {
                                                                            $responsibilities = trim($responsibilitiesMatches[1]); // Capture the responsibilities
                                                                        }
                                                                    @endphp

                                        <div class="work-item">
                                            <h4>{{ $role }}</h4>
                                            <p class="work-date">{{ $company }}</p>
                                            <ul>
                                                <li>{{ $responsibilities }}</li>
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>



                                    <div class="cv-section">
                                        <h2>Education</h2>
                                        @php
                                        // Split the education string into an array if it contains multiple entries
                                        $educations = explode("\n", $student->cv->education ?? '');
                                        @endphp

                                        <ul class="education-list">
                                            @foreach ($educations as $education)
                                            <li>{{ trim($education) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                   


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
      

    </div>

    <script>
    // Function to show SweetAlert if there's a success message
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

    // Function to show SweetAlert for error messages
    function showErrorMessages() {
        const errors = @json($errors->all());

        if (errors.length > 0) {
            Swal.fire({
                title: 'Error!',
                text: errors.join('\n'), // Join errors into a single string with line breaks
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    }

    // Call the functions to display the messages when the page loads
    document.addEventListener('DOMContentLoaded', () => {
        showSuccessMessage();
        showErrorMessages(); // Call the error message function
    });

    // Delete confirmation and action
    document.querySelectorAll('[data-btn-delete]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action

            let eventId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    let deleteUrl = `/events/${eventId}`;
                    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    axios.delete(deleteUrl, {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        Swal.fire(
                            'Deleted!',
                            'The event has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    })
                    .catch(error => {
                        console.error('Error deleting event:', error.response);

                        Swal.fire(
                            'Error!',
                            error.response && error.response.data && error.response.data.error ?
                            error.response.data.error :
                            'There was a problem deleting the event.',
                            'error'
                        );
                    });
                }
            });
        });
    });
</script>


<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>

<!-- Bootstrap JS and Popper.js -->
<script src="/Inchargedashboard/assets/js/svg-injector.min.js"></script>
<script src="/Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
<script src="/Inchargedashboard/assets/js/main.js"></script>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="/Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="/Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/Inchargedashboard/assets/js/main.js"></script>


</html>