<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Tracking - TalentHive</title>
    <link rel="shortcut icon" href="../Supervisordashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Supervisordashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="../Inchargedashboardassets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../Supervisordashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Supervisordashboard/assets/css/style.css">
</head>
<style>
.progress-tracking {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.student-progress,
.interaction-status {
    background-color: white;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 48%;
    margin-bottom: 20px;
}

.student-card,
.interaction-card {
    margin: 0rem;
    padding: 1rem;
    /* border: 1px solid #ddd; */
    border-radius: 4px;
}


.student-card h3,
.interaction-card h3 {
    margin: 0 0 0.5rem;
}

.progress-bar {
    background-color: #e0e0e0;
    border-radius: 5px;
    overflow: hidden;
    margin: 0.5rem 0;
}

.progress {
    background-color: #28a745;
    height: 20px;
    border-radius: 5px;
    transition: width 0.5s ease;
}

button {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-right: 0.5rem;
}

button:hover {
    background-color: #0056b3;
}

.hidden {
    display: none;
}

h6 {
    /* border-bottom: 2px solid #007BFF; */
    padding-bottom: 0.5rem;
}

.center {
    text-align: center;
    /* margin-top: 0px; Adjust as needed */
}

.status-tracking {
    text-align: center;
    margin-top: 20px;
}

.student-names {
    display: inline;
    /* Ensure the names are displayed inline */
    margin: 0;
    /* Remove margin */
    padding: 0;
    /* Remove padding */
}
</style>

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
            <h1 class="mb-0 fs-4 fw-semibold">Status Tracking</h1>
        </div>
    </div>
    <div class="card shadow-none border-0">
        <div class="card-body py-4">
            <div class="vstack gap-3">
                @foreach ($projects as $project)
                <div class="card">
                    <div class="card-body">
                        <div class="hstack justify-content-between gap-3 flex-wrap">
                            <div class="col-md-12">
                                <div class="student-card" id="project{{ $project->id }}">
                                    <h5>{{ $project->title }}</h5>
                                    <span>Students: <span class="student-names">
                                            @foreach ($project->students as $student)
                                            {{ $student->name }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </span></span></span>
                                    <p>Status: <strong>{{ $project->status }}</strong></p>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: {{ $project->progress }}%;"></div>
                                    </div>
                                    <p>Progress: <span class="progress-value">{{ $project->progress }}%</span></p>
                                    <div id="buttonContainer{{ $project->id }}">
                                        <button class="show-buttons" onclick="showUpdateButtons('buttonContainer{{ $project->id }}')">Update
                                            Buttons</button>
                                        <button class="toggle-button hidden" onclick="updateProgress('project{{ $project->id }}', 10)">Increase
                                            Progress</button>
                                        <button class="toggle-button hidden" onclick="updateProgress('project{{ $project->id }}', -10)">Decrease
                                            Progress</button>
                                        <button class="toggle-button hidden" onclick="saveProgress('buttonContainer{{ $project->id }}')">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Pagination links -->
            <div class="mt-4">
                {{ $projects->links() }} <!-- This will generate pagination links -->
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>

    <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Studentdashboard/assets/js/main.js"></script>
    <script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
    function showUpdateButtons(containerId) {
        const buttons = document.querySelectorAll(`#${containerId} .toggle-button`);
        buttons.forEach(button => {
            button.classList.toggle('hidden');
        });
    }

    function updateProgress(projectId, change) {
        const projectCard = document.getElementById(projectId);
        const progressValueElement = projectCard.querySelector('.progress-value');
        const progressBarElement = projectCard.querySelector('.progress');

        // Parse current progress
        let currentProgress = parseInt(progressValueElement.textContent);
        currentProgress = Math.max(0, Math.min(100, currentProgress + change)); // Clamp between 0 and 100

        // Update UI
        progressValueElement.textContent = currentProgress + '%';
        progressBarElement.style.width = currentProgress + '%';

        // Store the updated progress temporarily
        projectCard.dataset.updatedProgress = currentProgress;
    }

    function saveProgress(containerId) {
        const projectCard = document.getElementById(containerId.replace('buttonContainer', 'project'));
        const projectId = projectCard.id.replace('project', '');
        const updatedProgress = projectCard.dataset.updatedProgress;

        // Send the updated progress to the server
        fetch(`/supervisor/projects/${projectId}/update-progress`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                },
                body: JSON.stringify({
                    progress: updatedProgress
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Progress updated successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update progress: ' + data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
    }
    </script>


</body>

</html>