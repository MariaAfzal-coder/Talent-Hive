<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home - TalentHive</title>
    <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Studentdashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Studentdashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Studentdashboard/assets/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<style>
.message.left {
    align-self: flex-start;
    /* Aligns the message to the left */
}

.message.right {
    align-self: flex-end;
    /* Aligns the message to the right */
}

.message.left .chat {
    background-color: #f1f1f1;
    /* Style for company messages */
    border-radius: 10px 10px 10px 0;
    padding: 10px;
    margin-bottom: 5px;
}


.message.right .chat {
    background-color: #e6f7ff; /* soft blue background */
    max-width: 80%; /* Set the width of the message */

    /* Style for company messages */
    color: black;
    /* White text for contrast */
    border-radius: 10px 10px 0 10px;
    padding: 10px;
    margin-bottom: 5px;
}.list-group-item.active {
    background-color: #f0f0f0; /* Change this color to your preference */
    color: #333; /* Change text color if needed */
}
</style>

<body>
    <!-- Dimmed Background -->
    <div class="dim-background" id="dimBackground"></div>

    <!-- Sidebar -->
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
       href="{{ route('student.profile') }}">
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

    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('student.includes.navbar')

 
        <div class="container-fluid pc-gutter mt-4 pb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Sidebar for contacts -->
                        <div class="col-12 col-md-4 col-xl-3 messages-sidebar" id="messages-sidebar">
                            <div class="hstack gap-2 justify-content-between mb-3">
                                <h5 class="mb-0">Chats</h5>
                                <img src="assets/images/icon/close.svg" alt="Close Icon" id="close-messages-sidebar"
                                    class="close-icon d-md-none" height="25px" width="25px">
                            </div>
                            <div class="list-group">
    @forelse ($groupedChats as $participantId => $chatGroup)
        @php
            $chat = $chatGroup;
            $otherUser = $chat->sender_id === $loggedStudentId ? $chat->companyReceiver : $chat->companySender;
            $lastMessageTime = \Carbon\Carbon::parse($chat->created_at)->diffForHumans();
        @endphp

        @if ($otherUser)
            <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex flex-column px-2"
                onclick="fetchMessages({{ $otherUser->id }}, '{{ $otherUser->name }}', '{{ $otherUser->profile_image ? Storage::url($otherUser->profile_image) : asset('assets/images/avatar.jpg') }}')">
                <div class="hstack gap-2">
                    <img src="{{ $otherUser->profile_image ? Storage::url($otherUser->profile_image) : asset('assets/images/avatar.jpg') }}"
                         height="40" width="40" alt="User" class="user-avatar" style="border-radius: 50%;">
                    <div>
                        <h6 class="mb-0 fw-semibold text-md">{{ $otherUser->name }}</h6>
                        <span class="text-secondary text-sm">{{ $lastMessageTime }}</span>
                    </div>
                </div>
            </a>
        @endif
    @empty
        <p>No chats available</p>
    @endforelse
</div>

 

                        </div>

                        <!-- Main Chat Window -->
                        <div class="col-12 col-md-8 col-xl-9">
                            <div class="">
                                <div class="hstack gap-2 align-items-center justify-content-between flex-wrap">
                                    <div class="message-author hstack gap-2 align-items-center flex-wrap">
                                        <img id="currentCompanyImage"
                                            
                                            height="40" width="40" alt=" " class="user-avatar">
                                        <div class="d-flex flex-column">
                                            <h6 id="currentCompanyName" class="mb-0 fw-semibold text-lg">Select a
                                                company to chat</h6>
                                            <span class="text-secondary text-sm hstack gap-2"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <!-- Chat Messages -->
                            <div class="messages overflow-auto mb-3" style="max-height: 70vh;"></div>

                            <div class="mt-3 px-3 hstack gap-2">
                                <input type="text" id="messageInput" class="form-control"
                                    placeholder="Type a message here...">
                                <button class="btn btn-success" id="sendButton" type="button"
                                    onclick="sendMessage()">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
$(document).ready(function() {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: "5000"
    };

    $('#sendButton').click(function() {
    const messageInput = $('#messageInput').val().trim();
    const receiverId = window.currentReceiverId;

    if (!messageInput) {
        toastr.warning('Please enter a message.');
        return;
    }

    $.ajax({
        url: '/student/messages/send',
        method: 'POST',
        data: {
            receiver_id: receiverId,
            message: messageInput,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            $('#messageInput').val('');
            console.log(response);  // Log the response to check its structure
            displaySentMessage(response);
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON?.error || 'An error occurred');
        }
    });
});

function displaySentMessage(response) {
    const messageText = response.message || 'Message not available';
    const createdAt = response.created_at ? new Date(response.created_at).toLocaleTimeString() : 'Time not available';

    $('.messages').append(`
        <div class="message right">
            <div class="chat">
                <p>${messageText}</p>
                <time>${createdAt}</time>
            </div>
        </div>
    `);
    $('.messages').scrollTop($('.messages')[0].scrollHeight);
    scrollToBottom(); // Scroll to the bottom after fetching messages

}

    window.fetchMessages = function(companyId, companyName, companyImage) {
        window.currentReceiverId = companyId;

        $.ajax({
            url: `/student/messages/${companyId}`,
            method: 'GET',
            success: function(data) {
                $('.messages').empty();
                $('#currentCompanyImage').attr('src', companyImage);
                $('#currentCompanyName').text(companyName);

                data.forEach(function(message) {
                    var messageClass = message.sender_id == '{{ $LoggedStudentInfo->id }}' ? 'right' : 'left';
                    $('.messages').append(`
                        <div class="message ${messageClass}">
                            <div class="chat">
                                <p>${message.message}</p>
                                <time>${new Date(message.created_at).toLocaleTimeString()}</time>
                            </div>
                        </div>
                    `);
                });
                $('.messages').scrollTop($('.messages')[0].scrollHeight);


                scrollToBottom();

            },
            error: function(xhr) {
                alert('Error fetching messages: ' + (xhr.responseJSON?.error || 'An error occurred.'));
            }
        });
    };
 
});
function scrollToBottom() {
    const messagesContainer = document.querySelector('.messages');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}
</script>
<!-- Include Pusher JS library -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Initialize Pusher
    Pusher.logToConsole = true; // Enable logging for debugging
    const pusher = new Pusher('89f4dd829f60fced8820', { // Replace with your Pusher app key
        cluster: 'ap2' // Replace with your Pusher app cluster
    });

    // Subscribe to the company chat channel
    const channel = pusher.subscribe('company-chat');

    // Listen for the CompanyMessageSent event
    channel.bind('App\\Events\\CompanyMessageSent', function(data) {
        console.log('Received data:', data); // Log to check if the event is triggered

        // Ensure message data exists
        if (data && data.message) {
            const messageClass = 'left'; // Set to 'left' for all messages

            // Format the timestamp
            const createdAt = new Date(data.created_at);
            const formattedTime = createdAt.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            // Append the new message to the chat window
            $('.messages').append(`
                <div class="message ${messageClass}">
                    <div class="chat">
                        <p>${data.message}</p>
                        <time>${formattedTime}</time>
                    </div>
                </div>
            `);

            // Scroll to the bottom to show the new message
            $('.messages').scrollTop($('.messages')[0].scrollHeight);
        } else {
            console.log('No message data received');
        }
    });
</script>




        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        function fetchMessages(studentId, studentName, studentImage) {
            window.currentReceiverId = studentId; // Set the current receiver ID

            $.ajax({
                url: '/company/messages/' + studentId,
                method: 'GET',
                success: function(data) {
                    $('.messages').empty(); // Clear existing messages
                    $('.message-author img').attr('src', studentImage);
                    $('.message-author h6').text(studentName);

                    var loggedCompanyId = {
                        {
                            session('LoggedCompanyInfo')
                        }
                    };
                    data.forEach(function(message) {
                        var messageClass = message.sender_id === loggedCompanyId ? 'right' : 'left';

                        var messageHtml = `
                    <div class="message ${messageClass}">
                        <div class="chat">
                            <p>${message.message}</p>
                            <time>${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</time>
                        </div>
                    </div>`;
                        $('.messages').append(messageHtml);
                    });
                },
                error: function(xhr) {
                    alert('Error fetching messages: ' + (xhr.responseJSON?.error || 'An error occurred.'));
                }
            });
        }
        </script>

        <!-- Bootstrap JS and Popper.js -->
        <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
        <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="../Studentdashboard/assets/js/main.js"></script>
</body>

</html>