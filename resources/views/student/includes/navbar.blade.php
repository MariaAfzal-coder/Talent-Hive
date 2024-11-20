<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid pc-gutter hstack">
        <div class="nav-left hstack gap-1">
            <button class="navbar-toggler d-lg-none me-2 border-0 p-0" type="button" id="sidebarToggle">
                <img src="../Studentdashboard/assets/images/icon/menu.svg" alt="Menu Icon" height="30px" width="30px">
            </button>
            <div class="logo d-lg-none me-1">
                <img src="../Studentdashboard/assets/images/logo.svg" alt="Logo" width="140" class="img-fluid">
            </div>
        </div>

        <div class="d-flex align-items-center nav-right gap-2 gap-lg-4">

            <div class="icons d-flex align-items-center gap-2">
                <div class="notification-dropdown" style="position: relative;">
                    <a href="#" id="notificationBell" data-bs-toggle="dropdown" aria-expanded="false"
                        style="position: relative;">
                        <i class="fas fa-bell"></i>
                        @if($notificationCount > 0)
                        <span class="notification-count" id="notificationCount">{{ $notificationCount }}</span>
                        @endif
                    </a>

                    <!-- Notification Dropdown -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationBell">
                        <li class="dropdown-header">Notifications ({{ $notificationCount }})</li>
                        @if($notificationCount > 0)
                        @foreach($notifications as $notification)
                        <li class="list-group-item">
                            <strong>Interview Scheduled</strong><br>
                            Company: {{ $notification->company->name }}<br>
                            Date: {{ $notification->date }}<br>
                            Time: {{ $notification->time }}<br>
                            Venue: {{ $notification->venue }}
                            <!-- Link: <a href="{{ $notification->link }}" target="_blank">{{ $notification->venue }}</a> -->
                        </li>
                        @endforeach
                        @else
                        <li class="list-group-item">No new notifications.</li>
                        @endif
                    </ul>
                </div>
                <div class="dropdown" style="position: relative;">
    <!-- Button to toggle dropdown -->
    <a href="/student/chats"><i class="fas fa-comments"></i></a>


    
</div>



            </div>

            <div class="dropdown profile-dropdown">
                <a class="dropdown-toggle d-flex text-decoration-none" href="#" role="button" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="d-flex flex-column text-end d-none d-sm-flex">
                        <span class="text-md text-dark">{{ $LoggedStudentInfo->name }}</span>
                        <span class="text-secondary text-sm">{{ $LoggedStudentInfo->department }}</span>
                    </span>
                    <img src="{{ $LoggedStudentInfo->profile_image ? Storage::url($LoggedStudentInfo->profile_image) : asset('Studentdashboard/assets/images/avatar.jpg') }}"
                        height="40" width="40" alt="User" class="rounded-circle ms-2">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item" href="#">Profile</a>
                        <ul class="dropdown-menu dropdown-menu-left">
                        <li><a class="dropdown-item" href="{{ route('student.viewprofile') }}">View Profile</a></li>

                            <li><a class="dropdown-item" href="{{ route('student.profile') }}">Make Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('student.editprofile') }}">Edit Profile</a></li>
                        </ul>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('student.logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>/* Style the dropdown item for hover effect */
.dropdown-menu .dropdown-item:hover {
    background-color: #f1f1f1;
    color: #007bff;
}

/* Style the background for unread messages */
.dropdown-menu .message-item {
    background-color: #f9f9f9;
    transition: background-color 0.3s ease;
}

/* Hover effect on the message item */
.dropdown-menu .message-item:hover {
    background-color: #e9ecef;
}

/* Optional: Make sure the text is properly aligned */
.dropdown-menu .dropdown-item {
    display: flex;
    flex-direction: column;
}

/* Optional: Add some padding and margin to the dropdown menu */
.dropdown-menu {
    padding: 12px 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

<style>
.notification-count {
    background: red;
    color: white;
    padding: 2px 6px;
    position: absolute;
    top: -15px;
    /* Adjust as needed */
    right: -12px;
    /* Adjust as needed */
    border-radius: 50%;
    font-size: 12px;
}

.dropdown-menu {
    min-width: 300px;
    /* Adjust width */
    border-radius: 0.5rem;
    /* Rounded corners */
}

.dropdown-header {
    background: #f8f9fa;
    /* Light background */
    font-weight: bold;
    padding: 10px;
}

.list-group-item {
    padding: 15px;
    /* Adjust padding */
}

.list-group-item:hover {
    background-color: #f1f1f1;
    /* Hover effect */
}

.dropdown-divider {
    border-top: 1px solid #e9ecef;
    /* Divider style */
}
</style>

<script>
$(document).ready(function() {
    $('#notificationModal').on('shown.bs.modal', function() {
        // Focus on the modal
        $(this).find('.btn-close').focus();
    });
});
</script>
<!-- Include Toastr CSS -->

<!-- Include Toastr JS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Include Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Include Pusher JS -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<!-- Include Pusher JS -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
Pusher.logToConsole = true;

// Set Toastr options for persistent notifications
toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "0", // Set to 0 for persistent notification
    extendedTimeOut: "0", // Set to 0 for persistent notification
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut"
};

document.addEventListener('DOMContentLoaded', function() {
    var notificationCountElement = document.getElementById('notificationCount');

    // Initialize Pusher
    var pusher = new Pusher('89f4dd829f60fced8820', {
        cluster: 'ap2'
    });

    var loggedUserId = parseInt('{{ $LoggedStudentInfo->id }}');
    var channel = pusher.subscribe('student.' + loggedUserId); // Use public channel

    console.log('Subscribed to channel:', 'student.' + loggedUserId);

    // Bind to the schedule-interview event
    channel.bind('schedule-interview', function(data) {
        console.log('Interview Scheduled:', data);

        // Ensure student_id matches loggedUserId
        if (data.interview && parseInt(data.interview.student_id) === loggedUserId) {
            // Construct notification HTML
            var notificationHtml = `
                <div style="width: 800px; padding: 20px; font-family: Arial, sans-serif; line-height: 1.5;">
                    <strong style="font-size: 18px;">Interview Scheduled</strong><br>
                    <div style="margin-top: 10px;">
                        Interview with <strong>${data.company.name}</strong><br>
                        Date: <strong>${data.interview.date}</strong><br>
                        Time: <strong>${data.interview.time}</strong><br>
                        Link: <a href="${data.interview.link}" target="_blank">${data.interview.link}</a>
                    </div>
                </div>
            `;

            // Use Toastr to display the notification
            toastr.info(notificationHtml, '', {
                allowHtml: true
            });
            console.info('Notification Info:', `Interview with ${data.company.name} on ${data.interview.date} at ${data.interview.time}. Link: ${data.interview.link}`);

            // Update notification count
            var currentCount = parseInt(notificationCountElement.textContent.trim()) || 0;
            notificationCountElement.textContent = currentCount + 1; // Increment count
        } else {
            console.warn('Student ID does not match:', data.interview.student_id, 'Expected:', loggedUserId);
        }
    });
});
</script>


<style> 
    .icons {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .icons i {
        font-size: 1.5em;
        color: rgb(15, 114, 228);
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .icons i:hover {
        color: #1eeeb0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-info img {
        border-radius: 50%;
    }
    </style>





