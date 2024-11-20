<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Chat - TalentHive</title>
    <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Studentdashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Studentdashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Studentdashboard/assets/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<!-- Example CSS for styling -->
<style>
.messages {
    display: flex;
    flex-direction: column;
    
}

 
.message.left .chat {
    background-color: #f1f1f1;
    /* Style for student messages */
    border-radius: 10px 10px 10px 0;
    padding: 10px;
    margin-bottom: 5px;
    max-width: 80%; /* Set the width of the message */

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
}
</style>

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
                                @foreach ($groupedChats as $participantId => $participantChats)
                                @php
                                $otherUser = $participantChats->first()->sender_id === $LoggedCompanyInfo->id ?
                                $participantChats->first()->studentReceiver : $participantChats->first()->studentSender;
                                $lastMessage = $participantChats->last();
                                $lastMessageTime = \Carbon\Carbon::parse($lastMessage->created_at)->diffForHumans();
                                @endphp
                                <a href="#" class="list-group-item list-group-item-action d-flex flex-column px-2"
                                    onclick="fetchMessages({{ $otherUser->id }}, '{{ $otherUser->name }}', '{{ Storage::url($otherUser->profile_image) }}')">
                                    <div class="hstack gap-2">
                                        <img src="{{ Storage::url($otherUser->profile_image) }}" height="40" width="40"
                                            alt="User" class="user-avatar" style="border-radius: 50%;">
                                        <div>
                                            <h6 class="mb-0 fw-semibold text-md">{{ $otherUser->name }}</h6>
                                            <span class="text-secondary text-sm">{{ $lastMessageTime }}</span>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Main Chat Window -->
                        <div class="col-12 col-md-8 col-xl-9">
                            <div class="">
                                <div class="hstack gap-2 align-items-center justify-content-between flex-wrap">
                                    <div class="message-author hstack gap-2 align-items-center flex-wrap">
                                        <img  
                                            height="40" width="40"   class="user-avatar">
                                        <div class="d-flex flex-column">
                                        <h6 id="currentCompanyName" class="mb-0 fw-semibold text-lg">Select a
                                        Student to chat</h6>                                            <span class="text-secondary text-sm hstack gap-2"><span class=""></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <!-- Chat Messages -->
                            <div class="messages overflow-auto mb-3" style="max-height: 70vh;">
                                <!-- Messages will be dynamically populated here -->
                            </div>

                            <!-- Message input and send button -->
                            <div class="mt-3 px-3 hstack gap-2">
                                <input type="text" id="messageInput" class="form-control"
                                    placeholder="Type a message here...">
                                <button class="btn btn-success" id="sendButton" type="button">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

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
$(document).ready(function() {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $('#sendButton').click(function() {
        const messageInput = $('#messageInput');
        const message = messageInput.val();
        const receiverId = window.currentReceiverId;

        if (message.trim() === '') {
            toastr.warning('Please enter a message.');
            return;
        }

        const sendButton = $(this);
        sendButton.prop('disabled', true).text('Sending...');

        $.ajax({
            url: '/company/send-message',
            method: 'POST',
            data: {
                receiver_id: receiverId,
                message: message,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                messageInput.val('');
                const messageHtml = `
                    <div class="message right">
                        <div class="chat">
                            <p>${response.message}</p>
                            <time>${new Date(response.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</time>
                        </div>
                    </div>`;
                $('.messages').append(messageHtml);
                scrollToBottom();

            },
            error: function(xhr) {
                let errorMessage = 'An error occurred.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                } else if (xhr.statusText) {
                    errorMessage = xhr.statusText;
                }
                toastr.error(errorMessage, 'Error', { timeOut: 5000 });
            },
            complete: function() {
                sendButton.prop('disabled', false).text('Send');
            }
        });
    });
});
function scrollToBottom() {
    const messagesContainer = document.querySelector('.messages');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}

function fetchMessages(studentId, studentName, studentImage) {
    window.currentReceiverId = studentId; // Set the current receiver ID

    $.ajax({
        url: '/company/messages/' + studentId,
        method: 'GET',
        success: function(data) {
            $('.messages').empty(); // Clear existing messages
            $('.message-author img').attr('src', studentImage);
            $('.message-author h6').text(studentName);

            var loggedCompanyId = {{ session('LoggedCompanyInfo') }};
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

            scrollToBottom(); // Scroll to the bottom after fetching messages

        },
        error: function(xhr) {
            alert('Error fetching messages: ' + (xhr.responseJSON?.error || 'An error occurred.'));
        }
    });
}
 
    // Enable Pusher logging for debugging (remove this in production)
    Pusher.logToConsole = true;

    // Initialize Pusher
    var pusher = new Pusher('89f4dd829f60fced8820', {
        cluster: 'ap2',
        encrypted: true
    });

    // Function to set up message listener
    function setupMessageListener(receiverId) {
        // Subscribe to the specific channel for the receiver
        var channel = pusher.subscribe(`doctor-messages`);

        // Bind to the event (message.sent) to listen for new messages
        channel.bind('message.sent', function(data) {
            console.log('New message received:', data); // Debugging line
            
            // Create HTML for the incoming message
            const messageHtml = `
                <div class="message left">
                    <div class="chat">
                        <p>${data.message}</p>
                        <time>${new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</time>
                    </div>
                </div>`;
            
            // Append the message to the chat window
            $('.messages').append(messageHtml);
            scrollToBottom();

        });
    }

      var currentReceiverId = 800; // This would be dynamically set in your actual application
    setupMessageListener(currentReceiverId);

    function openChatForStudent(studentId) {
    window.currentReceiverId = studentId;
    fetchMessages(studentId); // Fetch the messages for this specific student
    setupMessageListener(studentId); // Set up Pusher listener for this specific student
}
</script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Studentdashboard/assets/js/main.js"></script>
</body>

</html>