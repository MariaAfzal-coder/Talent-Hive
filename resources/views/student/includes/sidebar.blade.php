<div class="sidebar vstack justify-content-between">
    <div>
        <div class="logo p-0 d-flex align-items-center">
            <img src="../Studentdashboard/assets/images/logo.png" alt="Logo" width="35" class="img-fluid me-2">
            <h2 class="mb-0">Talent Hive</h2>
        </div>
        <ul class="nav flex-column mt-2 pb-5">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"
                    href="{{ route('student.dashboard') }}">
                    <img src="../Studentdashboard/assets/images/icon/home.svg" height="24" width="24" class="inject-svg"
                        alt="Home"> Home
                </a>
            </li>
            <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('student.profile', 'student.makeprofile', 'student.editprofile') ? 'active' : '' }}"
       href="{{ route('student.viewprofile') }}">
        <img src="../Studentdashboard/assets/images/icon/project-dashboard.svg" height="24" width="24"
             class="inject-svg" alt="Profile"> Profile
    </a>
</li>
            

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.projectdetails') ? 'active' : '' }}"
                    href="{{ route('student.projectdetails') }}">

                    <img src="../Studentdashboard/assets/images/icon/project-dashboard.svg" height="24" width="24"
                        class="inject-svg" alt="Projects"> Project Profile
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.createproject') ? 'active' : '' }}"
                    href="{{ route('student.createproject') }}">
                    <img src="../Studentdashboard/assets/images/icon/project-icon.png" height="24" width="24"
                        alt="Create Project"> Create Project
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.cv') ? 'active' : '' }}"
                    href="{{ route('student.cv') }}">
                    <img src="../Studentdashboard/assets/images/icon/cv-profile.png" height="24" width="24" alt="CV">
                    CV Creation
                </a>
            </li>


            <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('student.interview') ? 'active' : '' }}"
            href="{{ route('student.interview') }}">
        <img src="../Studentdashboard/assets/images/icon/video-call.png" height="24" width="24" alt="video call">
        Interview Schedule
    </a>
</li> 


<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('student.certificate') ? 'active' : '' }} 
               {{ $LoggedStudentInfo->certification_status === 'awarded' ? 'highlighted' : '' }}" 
       href="{{ route('student.certificate') }}">
        <i class="fas fa-certificate"style="color: #1fd187;" style="font-size: 24px; color: {{ $LoggedStudentInfo->certification_status === 'awarded' ? '#1fd187' : '#000' }};"></i> <!-- Font Awesome icon with dynamic color -->
        Certificate Awarded
    </a>
</li>


   
        </ul>
    </div>
</div>

<style>.highlighted {
    background-color: #e8f5e9; /* Light green background */
    font-weight: bold; /* Make the text bold */
    border-left: 4px solid #1fd187; /* Green left border */
}
</style>



<!-- Include Pusher JS -->
 <!-- Include Toastr CSS -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<!-- Include Toastr JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
// Initialize Pusher
Pusher.logToConsole = true;

var pusher = new Pusher('89f4dd829f60fced8820', {
    cluster: 'ap2'
});

// Subscribe to the company-chat channel
var channel = pusher.subscribe('company-chat');

// Listen for the App\Events\CompanyMessageSent event
channel.bind('App\\Events\\CompanyMessageSent', function(data) {
    // Log the received data to the console for debugging
    console.log("Received Pusher event data:", data);

    // Check if the receiver_id matches the logged-in user's ID
    var loggedInUserId = {{ $LoggedStudentInfo->id }}; // Pass the logged-in user's ID to JavaScript

    if (data.receiver_id == loggedInUserId) {
        // Display a Toastr notification with the message
        toastr.options = {
            "closeButton": true, // Show a close button
            "progressBar": true, // Show a progress bar
            "positionClass": "toast-top-right", // Position of the notification
            "timeOut": 0, // Disable automatic timeout (stays until closed)
            "extendedTimeOut": 0, // No additional timeout on mouse hover
            "onclick": function() {
                // Redirect to the chat page when the notification is clicked
                window.location.href = '/student/chats';
            }
        };

        // Fetch the company name using the sender_id
        fetch(`/get-company-name/${data.sender_id}`)
            .then(response => response.json())
            .then(company => {
                // Log the company data to the console for debugging
                console.log("Fetched company data:", company);

                // Show the notification with the company name and message
                toastr.info(`${company.name}: ${data.message}`, "New Message");
            })
            .catch(error => {
                // Log any errors to the console
                console.error('Error fetching company name:', error);
            });
    }
});
</script>
