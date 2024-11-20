<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - TalentHive</title>
    <link rel="shortcut icon" href="../Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        <div class="container-fluid pc-gutter mt-4">
            <div class="row g-3 mb-3">
                <div class="col-sm-5 col-md-4">
                    <h1 class="mb-0 fs-4 fw-semibold">Events</h1>
                </div>
                <div class="col-sm-7 col-md-8">
    <div class="hstack flex-wrap gap-2 justify-content-start justify-content-sm-end">
        @if ($inProgressEvent)
            <!-- Show a disabled button if there is an "In Progress" event -->
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#warningModal">Create New Event</button>
        @else
            <!-- Allow event creation if no event is "In Progress" -->
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#addEventModal">Create New Event</button>
        @endif
    </div>
</div>

<!-- Warning Modal for In Progress Event -->
<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="warningModalLabel">Event In Progress</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You cannot create a new event while another event is still in progress. Please wait for the current event to complete before creating a new one.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

            </div>
            @if(session('success'))
            <meta name="success-message" content="{{ session('success') }}">
            @endif
            <!-- Modal Structure -->
            <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEventModalLabel">Create New Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('events.store') }}" method="post" id="addEventForm">
                                @csrf
                                <div class="row g-3">
                                    <!-- Event Name -->
                                    <div class="col-md-4 col-sm-6">
                                        <label class="form-label">Event Name</label>
                                        <input type="text" class="form-control" name="event_name"
                                            placeholder="Event Name" required>
                                    </div>
                                    <!-- Session -->
                                    <div class="col-md-2 col-sm-6">
                                        <label class="form-label">Session</label>
                                        <select class="form-select" name="session" aria-label="Session" required>
                                            <option value="fall-2024">Fall 2024</option>
                                            <option value="spring-2024">Spring 2024</option>
                                            <option value="fall-2023">Fall 2023</option>
                                            <option value="spring-2023">Spring 2023</option>
                                            <option value="fall-2022">Fall 2022</option>
                                            <option value="spring-2022">Spring 2022</option>
                                        </select>
                                    </div>
                                    <!-- Start Date -->
                                    <div class="col-md-3 col-sm-6">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date"
                                            placeholder="Start Date" required>
                                    </div>
                                    <!-- End Date -->
                                    <div class="col-md-3 col-sm-6">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" name="end_date" placeholder="End Date"
                                            required>
                                    </div>
                                    <!-- Event Description -->
                                    <div class="col-12">
                                        <label class="form-label">Event Description</label>
                                        <textarea class="form-control" name="description"
                                            placeholder="Event Description" rows="5" required></textarea>
                                    </div>
                                    <!-- Incharge ID (Hidden) -->
                                    <input type="hidden" name="incharge_id" value="1">
                                    <!-- Assuming incharge_id is automatically filled -->

                                    <!-- Project Selection (Multiple) -->
                                    <div class="col-12">
                                        <label class="form-label">Select Projects</label>
                                        <div class="form-control">
                                            @foreach($projects as $project)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="projects[]"
                                                    value="{{ $project->id }}">
                                                <label class="form-check-label">
                                                    {{ $project->title }}
                                                    @if($project->status == 'Completed')
                                                    <span class="custom-badge-completed">Completed</span>
                                                    @elseif($project->status == 'In Progress')
                                                    <span class="custom-badge-progress">In Progress</span>
                                                    @elseif($project->status == 'Pending')
                                                    <span class="custom-badge-pending">Pending</span>
                                                    @else
                                                    <span class="custom-badge-unknown">Unknown</span>
                                                    @endif
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <small class="text-muted">Select multiple projects by checking the
                                            boxes.</small>
                                    </div>
                                    <style>
                                    .custom-badge-completed {
                                        background-color: #28a745;
                                        /* Green for Completed */
                                        color: white;
                                        padding: 0.2em 0.6em;
                                        border-radius: 0.2rem;
                                    }

                                    .custom-badge-progress {
                                        background-color: #ffc107;
                                        /* Yellow for In Progress */
                                        color: black;
                                        padding: 0.2em 0.6em;
                                        border-radius: 0.2rem;
                                    }

                                    .custom-badge-pending {
                                        background-color: #6c757d;
                                        /* Grey for Pending */
                                        color: white;
                                        padding: 0.2em 0.6em;
                                        border-radius: 0.2rem;
                                    }

                                    .custom-badge-unknown {
                                        background-color: #dc3545;
                                        /* Red for Unknown */
                                        color: white;
                                        padding: 0.2em 0.6em;
                                        border-radius: 0.2rem;
                                    }
                                    </style>

                                </div>
                                <div class="d-flex gap-2 flex-wrap mt-3">
                                    <button type="submit" class="btn btn-primary">Add Event</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <div class="vstack gap-3">
                        @foreach($events as $event)
                        <div class="card">
                            <div class="card-body">
                                <div class="hstack justify-content-between gap-3 flex-wrap">
                                    <img src="../Inchargedashboard/assets/images/icon/Idea.png" alt="Idea">
                                    <div class="vstack gap-1">
                                        <h3 class="fs-5 mb-0 fw-semibold d-flex flex-column">
                                            <!-- Event Name with link -->
                                            <a href="#" class="event-title text-decoration-none text-dark">
                                                {{ $event->event_name }}
                                            </a>

                                            <!-- Session badge -->
                                            <div class="d-flex align-items-center mt-2">
                                                <span
                                                    class="bg-success-subtle text-success-emphasis rounded-pill px-2 text-smxx event-status me-2">
                                                    {{ $event->session }}
                                                </span>
                                                <span
                                                    class="bg-success-subtle text-success-emphasis rounded-pill px-2 text-smxx event-status me-2">
                                                    Start Date:
                                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M, Y') }}
                                                </span>
                                               
                                                <span class="bg-success-subtle text-success-emphasis rounded-pill px-2 text-smxx event-status">
    @if ($event->status == 'Completed')
        Event completed on: {{ \Carbon\Carbon::parse($event->end_date)->format('d M, Y') }}
    @else
        End Date: {{ \Carbon\Carbon::parse($event->end_date)->format('d M, Y') }} |
        Status: <span class="text-secondary">In Progress</span>
    @endif
</span>

                                            </div>

                                            <!-- Event Description -->
                                            <div class="mt-3">
                                                <p class="text-muted" style="font-size: 0.9rem;">
                                                    {{ $event->description }}</p>
                                            </div>
                                        </h3>

                                        <div class="hstack column-gap-4 flex-wrap">
                                            <!-- Button to toggle project details -->
                                            <button class="btn mb-3 btn-secondary" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#projectDetails{{ $event->id }}" aria-expanded="false"
                                                aria-controls="projectDetails{{ $event->id }}">
                                                View Projects
                                            </button>

                                            <!-- Collapsible section for projects -->
                                            <div class="collapse project-details" id="projectDetails{{ $event->id }}">
                                                @foreach($event->projects as $project)
                                                <div class="small">
                                                    <strong>Title:</strong> {{ $project->title }}<br>
                                                    <strong>Status:</strong> {{ $project->status }}<br>
                                                    <strong>Members:</strong>
                                                    <div class="member-list d-flex flex-wrap"> <!-- Added flex-wrap for better alignment -->
    @foreach($project->students as $member) <!-- Assuming $project->students is the correct way to access members -->
        <div class="d-flex align-items-center mb-2 me-3"> <!-- Add 'me-3' for right margin between members -->
            <img class="avatar" 
                 src="{{ Storage::url($member->profile_image) }}" 
                 title="{{ $member->name }}" 
                 alt="User Avatar" 
                 style="width: 30px; height: 30px;"/> <!-- Set small size for avatars -->
            <span class="ms-1" style="font-size: 12px;">{{ $member->name }}</span> <!-- Smaller font size -->
        </div>
    @endforeach
</div>

                                                    <br>
                                                    <strong>Languages:</strong> @if (!empty($project->languages))
                                                    <span>{{ str_replace(['"', '[', ']'], '', implode(', ', array_map('trim', explode(',', $project->languages)))) }}</span>
                                                    @else
                                                    <span>No languages specified</span>
                                                    @endif<br>
                                                    <strong>Ending Date:</strong> {{ $project->ending_date }}<br>
                                                    <strong>Abstract:</strong>
                                                    <p class="mb-0">{{ $project->abstract }}</p>
                                                    <strong>Supervised By:</strong> {{ $project->supervisor ? $project->supervisor->name : 'Unknown' }}<br>
                                                    <strong>Video URL:</strong>
                                                    <div class="  mb-4"
                                                        style="width: 50%;  height: 50px; overflow: hidden;">
                                                        {!! $project->video_url !!}
                                                    </div>

                                                    <!-- Delete Button for Project -->
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <form
                                                            action="{{ route('project.destroy', ['event_id' => $event->id, 'project_id' => $project->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete
                                                                Project</button>
                                                        </form>
                                                    </div>
                                                    <hr>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                    <div class="hstack gap-1">
                                        <button class="btn btn-success-emphasis btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editEventModal-{{ $event->id }}"
                                            data-event-id="{{ $event->id }}">Edit</button>

          

                                        <!-- Delete Button with data-id attribute -->
                                        <button class="btn btn-danger-emphasis btn-sm" data-btn-delete
                                            data-id="{{ $event->id }}">Delete Event</button>

                                      

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>


                    @foreach($events as $event)


                    <!-- Edit Event Modal -->
                    <div class="modal fade" id="editEventModal-{{ $event->id }}" tabindex="-1"
                        aria-labelledby="editEventModalLabel-{{ $event->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editEventModalLabel-{{ $event->id }}">Edit Event -
                                        {{ $event->event_name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('events.update', $event->id) }}" method="post"
                                        id="editEventForm-{{ $event->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-3">
                                            <!-- Event Name -->
                                            <div class="col-md-4 col-sm-6">
                                                <label class="form-label">Event Name</label>
                                                <input type="text" class="form-control" name="event_name"
                                                    placeholder="Event Name" value="{{ $event->event_name }}" required>
                                            </div>
                                            <!-- Session -->
                                            <div class="col-md-2 col-sm-6">
                                                <label class="form-label">Session</label>
                                                <select class="form-select" name="session" aria-label="Session"
                                                    required>
                                                    <option value="fall-2024"
                                                        {{ $event->session == 'fall-2024' ? 'selected' : '' }}>Fall 2024
                                                    </option>
                                                    <option value="spring-2024"
                                                        {{ $event->session == 'spring-2024' ? 'selected' : '' }}>Spring
                                                        2024</option>
                                                    <option value="fall-2023"
                                                        {{ $event->session == 'fall-2023' ? 'selected' : '' }}>Fall 2023
                                                    </option>
                                                    <option value="spring-2023"
                                                        {{ $event->session == 'spring-2023' ? 'selected' : '' }}>Spring
                                                        2023</option>
                                                    <option value="fall-2022"
                                                        {{ $event->session == 'fall-2022' ? 'selected' : '' }}>Fall 2022
                                                    </option>
                                                    <option value="spring-2022"
                                                        {{ $event->session == 'spring-2022' ? 'selected' : '' }}>Spring
                                                        2022</option>
                                                </select>
                                            </div>
                                            <!-- Start Date -->
                                            <div class="col-md-3 col-sm-6">
                                                <label class="form-label">Start Date</label>
                                                <input type="date" class="form-control" name="start_date"
                                                    value="{{ $event->start_date }}" required>
                                            </div>
                                            <!-- End Date -->
                                            <div class="col-md-3 col-sm-6">
                                                <label class="form-label">End Date</label>
                                                <input type="date" class="form-control" name="end_date"
                                                    value="{{ $event->end_date }}" required>
                                            </div>
                                            <!-- Event Description -->
                                            <div class="col-12">
                                                <label class="form-label">Event Description</label>
                                                <textarea class="form-control" name="description" rows="5"
                                                    required>{{ $event->description }}</textarea>
                                            </div>
                                            <!-- Incharge ID (Hidden) -->
                                            <input type="hidden" name="incharge_id" value="1">
                                            <!-- Project Selection (Multiple) -->
                                            <div class="col-12">
                                                <label class="form-label">Select Projects</label>
                                                <div class="form-control">
                                                    @foreach($projects as $project)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="projects[]" value="{{ $project->id }}"
                                                            {{ in_array($project->id, $event->projects()->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                        <label class="form-check-label">
                                                            {{ $project->title }}
                                                            @if($project->status == 'Completed')
                                                            <span class="custom-badge-completed">Completed</span>
                                                            @elseif($project->status == 'In Progress')
                                                            <span class="custom-badge-progress">In Progress</span>
                                                            @elseif($project->status == 'Pending')
                                                            <span class="custom-badge-pending">Pending</span>
                                                            @else
                                                            <span class="custom-badge-unknown">Unknown</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <small class="text-muted">Select multiple projects by checking the
                                                    boxes.</small>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 flex-wrap mt-3">
                                            <button type="submit" class="btn btn-primary">Update Event</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-left mt-4">
    {{ $events->links() }}
</div>            
                </div>
       

            </div>
    
        </div>


    </div>
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



    <!-- Bootstrap JS and Popper.js -->
    <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/svg-injector.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Inchargedashboard/assets/js/main.js"></script>
</body>
<style>
.project-dropdown {
    width: 700%;
    /* Full width of the event card */
    padding: 10px;
    /* Add padding for better appearance */
    border-radius: 5px;
    /* Rounded corners */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    /* Light shadow */
}

.project-details {
    font-size: 12px;
    /* Smaller font size for project details */
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 5px;
    transition: max-height 0.3s ease-out;
}

.collapse:not(.show) {
    display: none;
}

.project-details .btn-danger {
    font-size: 12px;
}

.project-details p {
    margin-bottom: 0;
}

.project-dropdown .dropdown-item {
    padding: 10px 15px;
    white-space: normal;
    /* Allow text to wrap */
    font-size: 14px;
}

.project-dropdown .dropdown-item strong {
    color: #000;
    /* Bold text color */
}

.project-dropdown .dropdown-item a {
    color: #007bff;
    /* Link color */
    text-decoration: underline;
}

.project-dropdown .btn-danger {
    font-size: 12px;
}
</style>

</html>