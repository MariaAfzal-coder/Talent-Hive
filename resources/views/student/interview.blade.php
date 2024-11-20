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
</head>

<body>
    <!-- Dimmed Background -->
    <div class="dim-background" id="dimBackground"></div>

    <!-- Sidebar -->
    @include('student.includes.sidebar')


    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('student.includes.navbar')





        <!-- Page Content -->
        <!-- Page Content -->
        <div class="container-fluid pc-gutter mt-4 pb-4">
            <h1 class="mb-3 fs-4 fw-semibold">Interview Schedule</h1>

            @if (session('success'))
    <div class="alert alert-success">
        {!! session('success') !!}  
    </div>
@endif
            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <!-- Education table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-primary fw-bold">
                                    <th>Company Name</th>
                                    <th>Interview Date</th>
                                    <th>Interview Time</th>
                                    <th>Meeting Link</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @if($notifications->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">No scheduled interviews found.</td>
                                </tr>
                                @else
                                @foreach($notifications as $notification)
                                <tr>
                                <td>
    <a  class="d-flex align-items-center">
        <img src="{{ $notification->company->profile_image ? Storage::url($notification->company->profile_image) : asset('Studentdashboard/assets/images/avatar.jpg') }}"
            height="40" width="40" alt="Company Logo" class="rounded-circle me-2">
        {{ $notification->company->name }}
    </a>
</td>

                                    <td>{{ \Carbon\Carbon::parse($notification->date)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($notification->time)->format('h:i A') }}</td>
                                    <td>
                                        <a href="{{ $notification->link }}"
                                            target="_blank">{{ $notification->link }}</a>
                                    </td>
                                    <td> <i class="fas fa-comment chat-icon" data-bs-toggle="modal"
            data-bs-target="#chatModal{{ $notification->company->id }}"
            style="cursor: pointer; font-size: 1.5em; color: #007bff; transition: color 0.3s;"></i>

        <!-- Chat Modal -->
        <div class="modal fade" id="chatModal{{ $notification->company->id }}" tabindex="-1"
            aria-labelledby="chatModalLabel{{ $notification->company->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="chatModalLabel{{ $notification->company->id }}">
                            Chat with
                            <img src="{{ Storage::url($notification->company->profile_image) }}" alt="Profile Image" width="30" class="rounded-circle"
                                style="margin-left: 5px; margin-right: 5px;">
                            {{ $notification->company->name }} <!-- Display the company's name here -->
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('send.student.first.message') }}" method="POST">
                            @csrf
                             <input type="hidden" name="receiver_id" value="{{ $notification->company->id }}">
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
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Studentdashboard/assets/js/main.js"></script>
</body>

</html>