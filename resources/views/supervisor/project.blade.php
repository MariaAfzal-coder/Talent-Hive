<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project - TalentHive</title>
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
        <div class="container-fluid pc-gutter mt-4">
            <div class="row g-3 mb-3">
                <div class="col-sm-5 col-md-4">
                    <h1 class="mb-0 fs-4 fw-semibold">Projects</h1>
                </div>
            </div>

            <div class="card shadow-none border-0">
            <div class="card-body py-4">
    <div class="vstack gap-3">
        @foreach($projects as $project)
            <div class="card">
                <div class="card-body">
                    <div class="hstack justify-content-between gap-3 flex-wrap">
                        <img src="{{ $project->image ? Storage::url($project->image) : asset('Studentdashboard/assets/images/default-project.jpg') }}"
                             class="img-fluid rounded-circle border object-fit-cover" width="60" height="60" alt="Project Thumbnail">
                        <div class="vstack gap-1">
                            <h3 class="fs-5 mb-0 fw-semibold d-flex align-items-center">
                            <a href="{{ route('supervisor.project.show', $project->id) }}" class="event-title text-decoration-none text-dark">
    {{ $project->title }}
</a>

                                <span class="bg-success-subtle text-success-emphasis rounded-pill px-2 text-smxx event-status ms-3">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </h3>
                            <div class="hstack column-gap-4 flex-wrap">
                                <span>Students: <span class="students text-secondary">{{ $project->students->pluck('name')->implode(', ') }}</span></span>
                                <span>SDP: <span class="supervisor text-secondary">{{ $project->students->pluck('sdp')->implode(', ') }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
    <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Studentdashboard/assets/js/main.js"></script>
</body>

</html>