<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - TalentHive</title>
    <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Studentdashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Studentdashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Studentdashboard/assets/css/style.css">
</head>

<body>
    <!-- Dimmed Background -->
    <div class="dim-background" id="dimBackground"></div>

    @include('student.includes.sidebar')

    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('student.includes.navbar')
        <!-- Page Content -->
        <div class="container-fluid pc-gutter mt-4 pb-4">
            <h1 class="mb-3 fs-4 fw-semibold">Projects</h1>

            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <div class="row justify-content-lg-between">
                        <div class="col-lg-8">
                            @if ($projects->isNotEmpty())
                            @foreach ($projects as $project)
                            <div class="hstack gap-2 mb-3">
                                <div class="project-thumbnail">
                                    <img src="{{ $project->image ? Storage::url($project->image) : asset('Studentdashboard/assets/images/default-project.jpg') }}"
                                        class="img-fluid rounded-circle border object-fit-cover" width="60" height="60"
                                        alt="Project Thumbnail">
                                </div>
                                <h3 class="mb-0 fw-semibold fs-4">{{ $project->title }}</h3>
                            </div>
                            <p class="text-secondary">{{ $project->abstract }}</p>
                            <h5 class="mb-3 fw-semibold mt-4">Project Details</h5>
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge custom-badge">
                                    <strong>Supervised By:</strong>
                                    {{ $project->supervisor ? $project->supervisor->name : 'Unknown' }}
                                </span>

                                <span class="badge custom-badge">
                                    <strong>Status:</strong> {{ $project->status }}
                                </span>
                                <span class="badge custom-badge">
                                    <strong>Ending Date:</strong> {{ $project->ending_date }}
                                </span>
                            </div>

                            <style>
                            .custom-badge {
                                background-color: #d1fae5;
                                color: black;
                                font-size: 0.8rem;
                                padding: 4px 8px;
                                /* Adjusted padding */
                                border-radius: 20px;
                                /* Optional: Adjust border radius for a rounder badge */
                            }
                            </style>

                            @endforeach
                            @else
                            <p class="text-secondary">No projects available for this student.</p>
                            @endif

                            <!-- Comments Section -->
                            <h5 class="mb-3 fw-semibold mt-5">Comments</h5>
                            <hr>
                            <div class="comments-section">
                                                    
                                                @if ($project->comments && $project->comments->count() > 0)
                                        @foreach ($project->comments as $comment)
                                            <div class="d-flex mb-3">
                                            <img src="{{ $comment->company->profile_image ? Storage::url( $comment->company->profile_image) : asset('path/to/default-image.jpg') }}"
                                                alt="Company Profile Image"
                                                class="img-fluid rounded-circle" width="50" height="50">
                                                    <div class="ms-3">
                                                    <h5 class="mb-1 fw-semibold">{{ $comment->company->name }}</h5>
                                                    <p class="text-secondary">{{ $comment->comment }}</p>
                                                    <div class="hstack justify-content-between mb-2">
                                                        <small class="text-secondary fw-normal">{{ $comment->created_at->diffForHumans() }}</small>
                                                        <button class="btn shadow-none p-0" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#replyForm{{ $comment->id }}"
                                                            aria-expanded="false" aria-controls="replyForm{{ $comment->id }}">
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

                            </div>
                        </div>

                        <div class="col-lg-4">
                            @if ($projects->isNotEmpty())
                            @foreach ($projects as $project)
                            <!-- Project Video Embed YouTube -->
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
                                <div
                                    class="d-flex gap-2 align-items-center justify-content-between mb-3 text-decoration-none text-dark mb-2">
                                    <h5 class="mb-0 fs-6">{{ $member->name }}</h5>
                                    @if ($member->cv)
                                    <a href="{{ route('student.cv.download', ['id' => $member->id]) }}"
                                        class="text-decoration-none">Download CV</a>
                                    @else
                                    <span class="text-secondary">CV not created yet</span>
                                    @endif
                                </div>
                                @endforeach
                                @else
                                <p class="text-secondary">No group members specified</p>
                                @endif
                            </div>
                            @endforeach
                            @else
                            @endif
                        </div>

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
