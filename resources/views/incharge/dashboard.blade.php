<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incharge Home - TalentHive</title>
    <link rel="shortcut icon" href="../Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

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


        <!-- Page Content -->
        <!-- Page Content -->
        <div class="container-fluid pc-gutter mt-4 pb-4">
            <div class="hstack justify-content-between gap-2 mb-3">
                <h1 class="mb-0 fs-4 fw-semibold">Dashboard</h1>
                <div class="hstack flex-wrap gap-2 justify-content-start justify-content-sm-end">
                    <a href="{{ route('incharge.events') }}" class="btn btn-sm btn-primary">New Event</a>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="hstack justify-content-between gap-2 mb-3">
                                <h6 class="text-xl fw-semibold flex-shrink-0 mb-0 me-lg-3">Projects</h6>
                                <select class="form-select px-2 py-1 text-smx flex-shrink-1 w-auto pe-5"
                                    aria-label="Session">
                                    <option selected value="session">Session</option>
                                    <option value="fall">Fall</option>
                                    <option value="spring">Spring</option>
                                </select>
                            </div>
                            <div class="container">
                                <div class="card">
                                    <img src="../Inchargedashboard/assets/images/inc/project pics.png"
                                        alt="Static Picture">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="hstack justify-content-between gap-2 mb-3">
                                <h6 class="text-xl fw-semibold flex-shrink-0 mb-0 me-lg-3">Project Report</h6>
                                <select class="form-select px-2 py-1 text-smx flex-shrink-1 w-auto pe-5"
                                    aria-label="Project Report">
                                    <option selected disabled>Session</option>
                                    <option value="fall">Fall</option>
                                    <option value="spring">Spring</option>
                                </select>
                            </div>
                            <div class="report-chart-wrapper">
                                <canvas id="attendance-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="hstack justify-content-between gap-2 mb-3">
                                <h6 class="text-xl fw-semibold flex-shrink-0 mb-0 me-lg-3">Events</h6>
                                <select class="form-select px-2 py-1 text-smx flex-shrink-1 w-auto pe-5"
                                    aria-label="Attendance">
                                    <option selected value="session">Session </option>
                                    <option selected value="fall">Fall</option>
                                    <option value="spring">Spring</option>
                                </select>
                            </div>
                        </div>
                        <div class="vstack gap-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Open House (OnGoing Event)</h5>
                                    <p class="card-text">Event is going to be held at the main entrance ground. We
                                        welcome all the
                                        companies and the groups that are going to joining us for this event.</p>
                                    <a href="/incharge/events" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Full Report -->

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="hstack justify-content-between gap-2 mb-3">
                                <h6 class="text-xl fw-semibold flex-shrink-0 mb-0 me-lg-3">Full Report</h6>
                                <select class="form-select px-2 py-1 text-smx flex-shrink-1 w-auto pe-5"
                                    aria-label="Full Report">
                                    <option selected disabled>Session</option>
                                    <option value="fall">Fall</option>
                                    <option value="spring">Spring</option>
                                </select>
                            </div>
                            <div class="report-chart-wrapper">
                                <canvas id="report-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            


            </div>
        </div>

    </div>
    <script src="assets/js/svg-injector.min.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Inchargedashboard/assets/js/main.js"></script>
    <script>
    // Prepare the data for the chart
    var eventProjectCounts = @json($eventProjectCounts);

    // Extract event names and project counts
    var eventNames = eventProjectCounts.map(function(item) {
        return item.event_name; // Use event name directly
    });

    var projectCounts = eventProjectCounts.map(function(item) {
        return item.project_count;
    });

    // Create an array of unique colors for each event (you can also generate random colors)
    var eventColors = eventProjectCounts.map(function(item, index) {
        // Define a color for each event dynamically (you can use your own color logic here)
        return getColorForEvent(index); // Function to generate a color for each event
    });

    // Function to generate colors (you can customize this function)
    function getColorForEvent(index) {
        var colors = [
            '#42a5f5', // Blue
            '#ff7043', // Orange
            '#66bb6a', // Green
            '#ab47bc', // Purple
            '#ffca28'  // Yellow
            // Add more colors if needed
        ];
        return colors[index % colors.length]; // Loop back to the first color if there are more events than colors
    }

    // Create the chart using Chart.js
    var ctx = document.getElementById('report-chart').getContext('2d');
    var reportChart = new Chart(ctx, {
        type: 'bar', // You can change this to 'line' or 'pie' depending on the chart style you want
        data: {
            labels: eventNames, // Event names as labels
            datasets: [{
                label: 'Number of Projects',
                data: projectCounts,
                backgroundColor: eventColors, // Use dynamic event colors
                borderColor: eventColors,     // Border color for each event bar
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dynamic data from the server
        const projectsData = @json($projectsData); // Passing PHP data to JavaScript

        // Initialize project statuses data
        const statusData = {
            completed: 0,
            inProgress: 0
        };

        // Process the data to count completed and in-progress projects
        projectsData.forEach(project => {
            if (project.status === 'Completed') {
                statusData.completed = project.count;
            } else if (project.status === 'In Progress') {
                statusData.inProgress = project.count;
            }
        });

        // Data for the pie chart reflecting project statuses
        const attendanceData = {
            labels: ['Completed', 'In Progress'], // Updated labels to reflect the status
            datasets: [{
                label: 'Project Statuses',
                data: [statusData.completed, statusData
                .inProgress], // Dynamic values based on your data
                backgroundColor: ['#00b894',
                '#6c5ce7'], // Color scheme for Completed and In Progress
            }]
        };

        const attendanceConfig = {
            type: 'pie',
            data: attendanceData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: false,
                        text: 'Attendance'
                    }
                }
            },
        };

        const attendanceChart = new Chart(
            document.getElementById('attendance-chart'),
            attendanceConfig
        );




    });
    </script>

</body>

</html>