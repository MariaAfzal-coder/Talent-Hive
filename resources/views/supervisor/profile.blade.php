<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Profile- TalentHive</title>
    <link rel="shortcut icon" href="../Supervisordashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Supervisordashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="../Supervisordashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Supervisordashboard/assets/css/style.css">
</head>

<body>
    <!-- Dimmed Background -->
    <div class="dim-background" id="dimBackground"></div>

    <!-- Sidebar -->
    @include('supervisor.includes.sidebar')


    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('supervisor.includes.navbar')
        <div class="container-fluid pc-gutter mt-4 pb-4">
            <h1 class="mb-3 fs-4 fw-semibold">Profile</h1>
            @if (session('success'))
            <meta name="success-message" content="{{ session('success') }}">
            @endif


            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                <div>
        <h4 class="card-title">{{ $LoggedSupervisorInfo->name }}</h4>
        
         
        <div class="hstack gap-2 flex-wrap justify-content-center justify-content-sm-start">
            <span class="badge bg-light text-muted">
                Email: <a class="text-muted text-decoration-none" href="mailto:{{ $LoggedSupervisorInfo->email }}">{{ $LoggedSupervisorInfo->email }}</a>
            </span>
            <span class="vr"></span>
            <span class="badge bg-light text-muted">
                Phone: <a class="text-muted text-decoration-none" href="tel:{{ $LoggedSupervisorInfo->phone_number }}">{{ $LoggedSupervisorInfo->phone_number }}</a>
            </span>
        </div>
    </div>

                    <hr class="mb-0">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="biography-tab" data-bs-toggle="tab"
                                data-bs-target="#biography-tab-pane" type="button" role="tab"
                                aria-controls="biography-tab-pane" aria-selected="true">Biography</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="education-tab" data-bs-toggle="tab"
                                data-bs-target="#education-tab-pane" type="button" role="tab"
                                aria-controls="education-tab-pane" aria-selected="false">Education & Experience</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="awards-courses-tab" data-bs-toggle="tab"
                                data-bs-target="#awards-courses-tab-pane" type="button" role="tab"
                                aria-controls="awards-courses-tab-pane" aria-selected="false">Awards & Courses</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="other-tab" data-bs-toggle="tab"
                                data-bs-target="#other-tab-pane" type="button" role="tab" aria-controls="other-tab-pane"
                                aria-selected="false">Other</button>
                        </li>
                    </ul>

                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="biography-tab-pane" role="tabpanel"
                            aria-labelledby="biography-tab" tabindex="0">
                            <p class="text-secondary">{{ $LoggedSupervisorInfo->biography }}</p>
                        </div>

                        <div class="tab-pane fade" id="education-tab-pane" role="tabpanel"
                            aria-labelledby="education-tab" tabindex="0">
                            <h6 class="mt-3 mb-3 fw-semibold">Education Information:</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Degree</th>
                                            <th>Year</th>
                                            <th>Board/University</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($LoggedSupervisorInfo->education as $edu)
                                        <tr>
                                            <td>{{ $edu['degree'] ?? 'N/A' }}</td>
                                            <td>{{ $edu['year'] ?? 'N/A' }}</td>
                                            <td>{{ $edu['university'] ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <h6 class="mt-3 mb-3 fw-semibold">Experience Information:</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Post Hold</th>
                                            <th>From</th>
                                            <th>To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($LoggedSupervisorInfo->experience as $exp)
                                        <tr>
                                            <td>{{ $exp['post_hold'] ?? 'N/A' }}</td>
                                            <td>{{ $exp['from_year'] ?? 'N/A' }}</td>
                                            <td>{{ $exp['to_year'] ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="awards-courses-tab-pane" role="tabpanel"
                            aria-labelledby="awards-courses-tab" tabindex="0">
                            <h6 class="mt-3 mb-3 fw-semibold">Awards & Courses Information:</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Year</th>
                                            <th>Organization</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($LoggedSupervisorInfo->awards_courses as $award)
                                        <tr>
                                            <td>{{ $award['title'] ?? 'N/A' }}</td>
                                            <td>{{ $award['year'] ?? 'N/A' }}</td>
                                            <td>{{ $award['organization'] ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="other-tab-pane" role="tabpanel" aria-labelledby="other-tab"
                            tabindex="0">
                            <h6 class="mt-3 mb-3 fw-semibold">Additional Details:</h6>
                            <p class="text-secondary">
                                {{ $LoggedSupervisorInfo->additional_details ?? 'No additional details provided.' }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>
    <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/svg-injector.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Inchargedashboard/assets/js/main.js"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script>
    // Check if there is a success message in the session
    // Function to show SweetAlert if there's a success message
    function showSuccessMessage() {
        // Check if there is a success message in the session
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

    // Call the function to display the message when the page loads
    document.addEventListener('DOMContentLoaded', showSuccessMessage);

    document.querySelectorAll('[data-btn-delete]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action

            // Get the event ID from the button's data-id attribute
            let eventId = this.getAttribute('data-id');

            // Show SweetAlert confirmation dialog
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
                    // Construct delete URL dynamically
                    let deleteUrl = `/events/${eventId}`;

                    // Set the CSRF token
                    let csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    // If user clicks "Yes", send delete request to backend
                    axios.delete(deleteUrl, {
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Include CSRF token in request
                            }
                        })
                        .then(response => {
                            Swal.fire(
                                'Deleted!',
                                'The event has been deleted.',
                                'success'
                            ).then(() => {
                                // Reload the page or redirect after deletion
                                location.reload();
                            });
                        })
                        .catch(error => {
                            // Log the error to the console for debugging
                            console.error('Error deleting event:', error.response);

                            Swal.fire(
                                'Error!',
                                error.response && error.response.data && error.response
                                .data.error ?
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

    <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Studentdashboard/assets/js/main.js"></script>
</body>

</html>