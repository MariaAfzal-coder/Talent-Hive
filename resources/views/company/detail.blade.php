<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - TalentHive</title>
    <link rel="shortcut icon" href="/Companydashboard/assets/images/logo.png" type="image/x-icon">
    <link href="/Companydashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="/Companydashboard/assets/css/font.css">
    <link rel="stylesheet" href="/Companydashboard/assets/css/style.css">
    <style>
    .logo {
        display: flex;
        align-items: center;
    }

    .logo h2 {
        margin-left: 10px;
        /* Adjust spacing between the logo and text */
        font-size: 1.5rem;
        /* Adjust font size as needed */
        color: #333;
        /* Adjust text color as needed */
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: -100%;
        /* Adjust this value to your needs */
        margin-top: 0;
    }

    /* Optional: To show the submenu on hover */
    .dropdown-submenu:hover .dropdown-menu {
        display: block;
    }
    </style>
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
        <div class="container-fluid pc-gutter mt-4">
            <div class="container-fluid pc-gutter mt-4 pb-4">
                <h1 class="mb-3 fs-4 fw-semibold">{{ $project->title }}</h1>

                <div class="card shadow-none border-0">
                <div class="card-body py-4 d-flex justify-content-center align-items-center">
    <div class="row justify-content-lg-between">
        <div class="col-lg-8">
            <div class="hstack gap-2 mb-3">
                <div class="project-thumbnail">
                    <img src="{{ $project->image ? Storage::url($project->image) : asset('Studentdashboard/assets/images/default-project.jpg') }}"
                        class="img-fluid rounded-circle border object-fit-cover" width="60" height="60" alt="Project Thumbnail">
                </div>
                <h3 class="mb-0 fw-semibold fs-4">{{ $project->title }}</h3>
            </div>
            <p class="text-secondary">{{ $project->abstract }}</p>

            <!-- Comments Section -->
            <h5 class="mb-3 fw-semibold mt-5">Comments</h5>
            <hr>
            <div class="comments-section">
                <!-- Existing comments loop -->
                @if ($project->comments && $project->comments->count() > 0)
                    @foreach ($project->comments as $comment)
                        <div class="d-flex mb-3">
                        <img src="{{ $comment->company->profile_image ? Storage::url( $comment->company->profile_image) : asset('path/to/default-image.jpg') }}"
     alt="Company Profile Image"
     class="img-fluid rounded-circle" width="60" height="60">
           <div class="ms-3">
                                <h5 class="mb-1 fw-semibold">{{ $comment->company->name }}</h5>
                                <p class="text-secondary">{{ $comment->comment }}</p>
                                <div class="hstack justify-content-between mb-2">
                                    <small class="text-secondary fw-normal">{{ $comment->created_at->diffForHumans() }}</small>
                                    <button class="btn shadow-none p-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#replyForm{{ $comment->id }}"
                                        aria-expanded="false" aria-controls="replyForm{{ $comment->id }}">
                                        <small class="text-secondary fw-normal">Reply</small>
                                    </button>
                                </div>
                                <div class="collapse" id="replyForm{{ $comment->id }}">
                                    <div class="card card-body p-2">
                                        <form   method="POST">
                                            @csrf
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            <textarea class="form-control" name="reply" rows="2" placeholder="Write a reply"></textarea>
                                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-secondary">No comments yet. Be the first to comment!</p>
                @endif

                <!-- Add Comment Button -->
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addCommentModal">Add Comment</button>
            </div>

            <!-- Modal for Adding a Comment -->
            <div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCommentModalLabel">Add Comment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                <input type="hidden" name="company_id" value="{{ $LoggedCompanyInfo->id }}">
                                <div class="mb-3">
                                    <textarea class="form-control" name="comment" rows="3" placeholder="Write your comment" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar content -->
        <div class="col-lg-4">
            <!-- Project Video Embed -->
            <div class="project-video mb-4" style="width: 100%; max-width: 100%; height: 300px; overflow: hidden;">
                <video width="100%" height="100%" controls>
                    <source src="{{ asset('storage/' . $project->video_url) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Languages -->
            <h5 class="mb-3 fw-semibold mt-4">Languages</h5>
            <div class="hstack gap-2">
                @if (!empty($project->languages))
                    <span>{{ str_replace(['"', '[', ']'], '', implode(', ', array_map('trim', explode(',', $project->languages)))) }}</span>
                @else
                    <span>No languages specified</span>
                @endif
            </div>

            <!-- Group Members -->
            <h5 class="mb-3 fw-semibold mt-4">Group Members</h5>
            <div class="group-members">
                @if ($project->students && $project->students->count() > 0)
                    @foreach ($project->students as $member)
                        <div class="d-flex gap-2 align-items-center justify-content-between mb-3 text-decoration-none text-dark">
                            <h5 class="mb-0 fs-6">{{ $member->name }}</h5>
                            @if ($member->cv)
                                <a href="{{ route('company.student.cv', ['id' => $member->id]) }}" class="text-decoration-none">View CV</a>
                            @else
                                <span class="text-secondary">CV not created yet</span>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="text-secondary">No group members specified</p>
                @endif
            </div>
        </div>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="/Companydashboard/assets/js/svg-injector.min.js"></script>
    <script src="/Companydashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/Companydashboard/assets/js/main.js"></script>
    <script>
    document.querySelectorAll('.dropdown-submenu > a').forEach((element) => {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            let submenu = this.nextElementSibling;
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        });
    });
    </script>
</body>

</html>
