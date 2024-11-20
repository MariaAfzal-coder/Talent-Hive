<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendence - TalentHive</title>
    <link rel="shortcut icon" href="../Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="../Inchargedashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Inchargedashboard/assets/css/style.css">
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

        <div class="container-fluid pc-gutter mt-4">
            <div class="row g-3 mb-3">
                <div class="col-sm-12">
                    <h1 class="mb-0 fs-4 fw-semibold">Attendance Tracking</h1>
                </div>
            </div>

            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <div class="vstack gap-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="hstack justify-content-between gap-3 flex-wrap">
                                    <h3 class="fs-5 mb-0 fw-semibold d-flex align-items-center">
                                        Events Attendance
                                    </h3>
                                    <div class="vstack gap-1">
                                        <div class="hstack gap-2 align-items-center">
                                            <form action="{{ route('incharge.attendence') }}" method="GET"
                                                class="d-flex">
                                                <select class="form-select me-2" id="eventSelect" name="event_id"
                                                    aria-label="Select Event"
                                                    style="min-width: 300px; max-width: 350px;">
                                                    <option selected disabled>-- Select Event --</option>
                                                    @foreach ($events as $event)
                                                    <option value="{{ $event->id }}">{{ $event->event_name }}
                                                        ({{ $event->session }})</option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-primary-emphasis btn-sm" type="submit"
                                                    style="min-width: 180px;">Show Attendance</button>
                                            </form>
                                        </div>
                                    </div>



                                    @if (session('success'))
                                    <meta name="success-message" content="{{ session('success') }}">
                                    @endif



                                </div>
                                <!-- Separate div for displaying the selected event details -->
                                <div class="mt-4 d-flex justify-content-center">
                                    @if ($selectedEventDetails)
                                    <div class="text-black fs-5 me-3 p-3">
                                        <strong>Selected Event:</strong> {{ $selectedEventDetails['name'] }}
                                    </div>
                                    <div class="text-black fs-5 p-3">
                                        <strong>Session:</strong> {{ $selectedEventDetails['session'] }}
                                    </div>
                                    @else
                                    <div class="text-muted fs-6">
                                        Please select an event to view the details.
                                    </div>
                                    @endif
                                </div>

                                <div class="mt-2">
                                    <form id="attendanceForm" action="{{ route('incharge.saveAttendance') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="event_id" id="selectedEventId"
                                            value="{{ request('event_id') }}">
                                        @if ($selectedEventDetails)

                                        <table class="table table-bordered" id="attendanceTable">
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>SAP ID</th>
                                                    <th>Project</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="attendanceList">
                                                @foreach ($students as $student)
                                                <tr>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->sapid }}</td>
                                                    <td>
                                                        @foreach ($student->projects as $project)
                                                        <span class="badge bg-primary me-1">{{ $project->title }}</span>
                                                        @endforeach
                                                        <span>{{ $student->sdp }}</span>
                                                    </td>
                                                    <td>
                                                        <select class="form-select"
                                                            name="attendance[{{ $student->id }}][status]">
                                                            <option value="Present"
                                                                {{ (isset($attendanceMap[$student->id]) && $attendanceMap[$student->id] == 'Present') ? 'selected' : '' }}>
                                                                Present</option>
                                                            <option value="Absent"
                                                                {{ (isset($attendanceMap[$student->id]) && $attendanceMap[$student->id] == 'Absent') ? 'selected' : '' }}>
                                                                Absent</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @else
                                        <div class="text-muted fs-6">

                                        </div>
                                        @endif
                                        <div class="text-left mt-3">
                                            @if ($selectedEventDetails)
                                            <button type="submit" class="btn btn-primary-emphasis btn-sm"
                                                id="saveAttendanceButton">Save Attendance</button>
                                            <button type="button" onclick="printTable()"
                                                class="btn btn-secondary btn-sm" id="exportToPdfButton">Export to
                                                PDF</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                                <!-- Include jsPDF and html2canvas -->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">
                                </script>
                                <script
                                    src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
                                </script>

                                <script>
                                function printTable() {
                                    // Select the table you want to print
                                    var table = document.getElementById("attendanceTable");

                                    // Get the event details from the page with null handling
                                    var eventName =
                                        "{{ isset($selectedEventDetails['name']) ? $selectedEventDetails['name'] : 'Event Name Not Available' }}"; // Pass the event name
                                    var session =
                                        "{{ isset($selectedEventDetails['session']) ? $selectedEventDetails['session'] : 'Session Not Available' }}"; // Pass the session

                                    // Use html2canvas to capture the table as an image
                                    html2canvas(table).then(function(canvas) {
                                        // Create a new window to display the canvas
                                        var printWindow = window.open('', '', 'height=600,width=800');
                                        printWindow.document.write(
                                            '<html><head><title>Print Attendance Report</title>');
                                        printWindow.document.write(
                                            '<link rel="stylesheet" href="path-to-your-stylesheet.css">'
                                        ); // Link to your CSS for styling
                                        printWindow.document.write('<style>');
                                        printWindow.document.write(
                                            'body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }'
                                        );
                                        printWindow.document.write('h2 { margin-bottom: 10px; }');
                                        printWindow.document.write('p { font-size: 18px; margin: 5px 0; }');
                                        printWindow.document.write('</style>');
                                        printWindow.document.write('</head><body>');

                                        // Add event name and session before the table
                                        printWindow.document.write('<h2>Attendance Report</h2>');
                                        printWindow.document.write('<p><strong>Event:</strong> ' + eventName +
                                            '</p>');
                                        printWindow.document.write('<p><strong>Session:</strong> ' + session +
                                            '</p>');

                                        // Add the table canvas to the print window
                                        printWindow.document.body.appendChild(canvas);
                                        printWindow.document.write('</body></html>');
                                        printWindow.document.close();
                                        printWindow.print(); // Trigger print
                                    }).catch(function(error) {
                                        console.error('Error printing the table:', error);
                                    });
                                }
                                </script>

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
                                                let csrfToken = document.querySelector(
                                                        'meta[name="csrf-token"]')
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
                                                        console.error(
                                                            'Error deleting event:',
                                                            error.response);

                                                        Swal.fire(
                                                            'Error!',
                                                            error.response && error
                                                            .response.data && error
                                                            .response
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


    <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/svg-injector.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Inchargedashboard/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


    <script>
    document.getElementById('eventSelect').addEventListener('change', function() {
        var selectedEventId = this.value;
        document.getElementById('selectedEventId').value = selectedEventId;
    });

    function removeRow(button) {
        var row = button.closest('tr');
        row.remove();
    }
    </script>


    <!-- Bootstrap JS and Popper.js -->
    <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Inchargedashboard/assets/js/main.js"></script>
</body>

</html>