<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Home - TalentHive</title>
    <link rel="shortcut icon" href="/Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="/Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="/Inchargedashboard/assets/css/font.css">
    <link rel="stylesheet" href="/Inchargedashboard/assets/css/style.css">
</head>
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

<body>
    <!-- Dimmed Background -->
    <div class="dim-background" id="dimBackground"></div>

     
    <!-- Sidebar -->
    @include('company.includes.sidebar')
    <script>
function analyzeCV(studentId) {
    // Hide the CV details
    document.querySelector('.cv-container').style.display = 'none';

    // Show a loading message with animation
    const loadingMessage = document.createElement('div');
    loadingMessage.innerHTML = '<h2 class="loading-text">Analyzing...</h2>';
    loadingMessage.className = 'loading-message';
    document.querySelector('.card-body').appendChild(loadingMessage);

    // Simulate a 10-second analysis
    setTimeout(() => {
        // Fetch the analysis results
        fetch(`/company/cv-analyzer/${studentId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse JSON response
            })
            .then(data => {
                // Replace loading message with the score
                document.querySelector('.card-body').innerHTML = `
                    <div class="result-container">
                        <h1>CV Analysis Complete!</h1>
                        <h2> Matching Skills Score:</h2>
                        <p class="score">${data.score} / 100</p>
                        <a href="#" class="btn btn-primary" onclick="openScheduleInterviewModal({{ $student->id }})">Schedule Interview</a>

                        <button onclick='showDetails(${JSON.stringify(data.matchingSkills).replace(/'/g, "\\'")})' class="btn btn-primary">Show Details</button>
                    </div>
                `;
            })
            .catch(error => {
                console.error('Error fetching CV analysis:', error);
                loadingMessage.innerHTML = '<h2>Error analyzing CV. Please try again.</h2>';
            });
    }, 10000); // 10 seconds delay
}

// Function to show matching skills
let detailsShown = false; // Flag to check if details have been shown

function showDetails(matchingSkills) {
    // Check if details have already been shown
    if (detailsShown) {
        return; // Exit if details have already been displayed
    }

    // Log matching skills to check if data is being passed
    console.log('Matching Skills:', matchingSkills);

    // Convert matchingSkills object to an array
    const skillsArray = Object.values(matchingSkills);

    // Build the HTML for the skills list
    const skillsHtml = skillsArray.length ? skillsArray.map(skill => `<li>${skill}</li>`).join('') : '<li>No matching skills found.</li>';

    // Update the result container to include matching skills
    document.querySelector('.result-container').innerHTML += `
        <h2>Matching Skills:</h2>
        <ul>
            ${skillsHtml}
        </ul>
    `;

    // Set the flag to true after showing details
    detailsShown = true;
}
</script>



 


<!-- Schedule Interview Modal -->
<!-- Schedule Interview Modal -->
<div class="modal fade" id="scheduleInterviewModal" tabindex="-1" aria-labelledby="scheduleInterviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scheduleInterviewModalLabel">Schedule an Interview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('interviews.store') }}" method="POST" id="interviewForm">
          @csrf
          <input type="hidden" id="studentId" name="studentId" value="">
          <div class="mb-3">
            <label for="date" class="form-label">Select Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
          </div>
          <div class="mb-3">
            <label for="time" class="form-label">Select Time</label>
            <input type="time" class="form-control" id="time" name="time" required>
          </div>
          <div class="mb-3">
            <label for="venue" class="form-label">Venue</label>
            <input type="text" class="form-control" id="venue" name="venue"  required>
          </div>
          <!-- <div class="mb-3">
            <a href="https://zoom.us/j/1234567890" target="_blank" class="btn btn-secondary w-100">Open Zoom Meeting</a>
          </div> -->
          <button type="submit" class="btn btn-primary w-100">Confirm Schedule</button>
        </form>
      </div>
    </div>
  </div>
</div>


    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('company.includes.navbar')
        <script>
function openScheduleInterviewModal(studentId) {
    document.getElementById('studentId').value = studentId; // Set the student ID
    var modal = new bootstrap.Modal(document.getElementById('scheduleInterviewModal'));
    modal.show(); // Show the modal
}
</script>

@if (session('success'))
    <meta name="success-message" content="{{ session('success') }}">
@endif

@if (session('error'))
    <meta name="error-message" content="{{ session('error') }}">
 
@endif

        <div class="container-fluid pc-gutter mt-4 pb-4">
        <h1 class="mb-3 fs-4 fw-semibold">
        <a href ="../../company/project"><i class="fas fa-arrow-left me-2"></i></a>
        CV Preview
    </h1>

            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <div class="d-flex gap-2 justify-content-center mt-3 flex-wrap">
                    <a href="#" class="btn btn-success" onclick="analyzeCV({{ $student->id }})">CV Analyzer</a>
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
</body>