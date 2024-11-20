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

            @if (session('success'))
    <div class="alert alert-success">
        {!! session('success') !!}  
    </div>
@endif
            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <div class="row g-3 justify-content-between">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-secondary">Candidate</th>
                                            <th scope="col" class="text-secondary">Skills</th>
                                            <th scope="col" class="text-secondary">Interview Date & Time</th>
                                            <th scope="col" class="text-secondary">Status</th>
                                            <th scope="col" class="text-secondary">Venue</th>
 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($interviews as $interview)
                                        <tr>
                                        <td>
    <img src="{{ Storage::url($interview->student->profile_image) }}" alt="Profile Image" style="border-radius: 50%; width: 50px; height: 50px;" />
 {{ $interview->student->name }}</td>

                                            <!-- Display Skills as Comma-Separated List -->
                                            <td style="width: 200px;">
                                                @if(isset($interview->student->cv) &&
                                                isset($interview->student->cv->skills))
                                                {{ implode(', ', json_decode($interview->student->cv->skills, true)) }}
                                                @else
                                                <span>No skills listed</span>
                                                @endif
                                            </td>

                                            <!-- Display Interview Date and Time -->
                                            <td style="width: 200px;">
                                                {{ \Carbon\Carbon::parse($interview->datetime)->format('d M Y, h:i A') }}
                                            </td>

                                            <!-- Display Status Dropdown -->
                                            <td>
    <span class="badge status-badge 
        @if($interview->status === 'hired') bg-success @elseif($interview->status === 'not_hired') bg-danger text-white @elseif($interview->status === 'interview_inprocess') bg-warning text-white @else bg-secondary @endif" 
        data-status="{{ $interview->status }}">
        @if($interview->status === 'hired')
            Hired
        @elseif($interview->status === 'not_hired')
            Not Hired
        @elseif($interview->status === 'interview_inprocess')
            Interview In Progress
        @else
            Unknown Status
        @endif
    </span>
</td>

                                            <td>
                                                {{ $interview->venue }}
                                            </td>

                                            <!-- Display Actions (Hire Candidate Button) -->
                                            <td>
    <div class="d-flex align-items-center"> <!-- Flexbox container -->
        <form action="{{ route('interviews.updateStatus') }}" method="POST" class="status-form me-2"> <!-- Added margin to the right -->
            @csrf
            <input type="hidden" name="id" value="{{ $interview->id }}">
            <select class="form-select status-dropdown" name="status" onchange="this.form.submit()">
                <option value="hired" {{ $interview->status == 'hired' ? 'selected' : '' }}>Hired</option>
                <option value="not_hired" {{ $interview->status == 'not_hired' ? 'selected' : '' }}>Not Hired</option>
                <option value="interview_inprocess" {{ $interview->status == 'interview_inprocess' ? 'selected' : '' }}>Interview In Process</option>
            </select>
        </form>
        
        <!-- Chat Icon -->
        <i class="fas fa-comment chat-icon" data-bs-toggle="modal" data-bs-target="#chatModal{{ $interview->student->id }}" style="cursor: pointer; font-size: 1.5em; color: #007bff; transition: color 0.3s;"></i>
    </div>

    <!-- Chat Modal -->
    <div class="modal fade" id="chatModal{{ $interview->student->id }}" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chatModalLabel">
                        Chat with 
                        <img src="{{ Storage::url($interview->student->profile_image) }}" alt="Profile Image" width="30" class="rounded-circle" style="margin-left: 5px; margin-right: 5px;">
                        {{ $interview->student->name }} <!-- Assuming the student's name is accessible -->
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('send.company.first.message') }}" method="POST">
    @csrf
    <input type="hidden" name="receiver_id" value="{{ $interview->student->id }}">
    <div class="mb-3">
        <label for="message" class="form-label">Enter your message:</label>
        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Send</button>
</form>

                </div>
            </div>
        </div>
    </div>
</td>

<style>
    .chat-icon {
        border: 1px solid #007bff;
        border-radius: 50%;
        padding: 5px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.3s;
        margin-left: 10px; /* Adjust margin if needed */
    }

    .chat-icon:hover {
        background-color: #e7f1ff;
        transform: scale(1.1);
    }
</style>


                                            <!-- Display Interview Link -->

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Suggested Projects Section -->

                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 


<script>// Function to show SweetAlert if there's a success message (optional)
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