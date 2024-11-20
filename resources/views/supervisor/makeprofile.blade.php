<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home - TalentHive</title>
    <link rel="shortcut icon" href="../Supervisordashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Supervisordashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="../Supervisordashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Supervisordashboard/assets/css/style.css">
</head>

<body>
    <!-- Dimmed Background -->
    <div class="dim-background" id="dimBackground"></div>

    <!-- Sidebar -->
    @include('supervisor.includes.sidebar')


    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('supervisor.includes.navbar')



        <div class="container-fluid pc-gutter mt-4 pb-4">
    <h1 class="mb-3 fs-4 fw-semibold">Make Profile</h1>

    <div class="card shadow-none border-0">
        <div class="card-body py-4">
            <form action="{{ route('supervisor.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="bio-tab" data-bs-toggle="tab" href="#bio" role="tab">Biography & Personal Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="education-experience-tab" data-bs-toggle="tab" href="#education-experience" role="tab">Education & Experience</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="awards-tab" data-bs-toggle="tab" href="#awards" role="tab">Awards & Additional Details</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <br>
                    <!-- Biography & Personal Details Tab -->
                    <div class="tab-pane fade show active" id="bio" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input  type="text" class="form-control" id="name" name="name" required value="{{ $LoggedSupervisorInfo->name }}" placeholder="Enter your name...">
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" required name="phone_number" value="{{ $LoggedSupervisorInfo->phone_number }}" placeholder="Enter your phone number...">
                            </div>
                            <div class="col-md-12">
                                <label for="biography" class="form-label">Biography</label>
                                <textarea class="form-control" id="biography" name="biography" required rows="3" placeholder="Enter your biography...">{{ $LoggedSupervisorInfo->biography }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="profile_image" class="form-label">Profile Image</label>
                                <input type="file" class="form-control" id="profile_image" required name="profile_image" accept="image/*">
                                @if ($LoggedSupervisorInfo->profile_image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($LoggedSupervisorInfo->profile_image) }}" required alt="Profile Image" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <label for="additional_details" class="form-label">Additional Details</label>
                                    <textarea class="form-control" id="additional_details"  name="additional_details" rows="3" placeholder="Any additional details...">{{ $LoggedSupervisorInfo->additional_details }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Education & Experience Tab -->
                    <div class="tab-pane fade" id="education-experience" role="tabpanel">
                        <h5 class="mt-4">Education</h5>
                        <div id="education-container">
                            @foreach ($LoggedSupervisorInfo->education ?? [] as $index => $edu)
                            <div class="row mb-3 education-entry">
                                <div class="col-md-4">
                                    <input type="text" required class="form-control" name="education[{{ $index }}][degree]" value="{{ $edu['degree'] ?? '' }}" placeholder="Degree">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" required class="form-control" name="education[{{ $index }}][year]" value="{{ $edu['year'] ?? '' }}" placeholder="Year">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" required class="form-control" name="education[{{ $index }}][university]" value="{{ $edu['university'] ?? '' }}" placeholder="University">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-education">Add More Education</button>

                        <h5 class="mt-4">Experience</h5>
                        <div id="experience-container">
                            @foreach ($LoggedSupervisorInfo->experience ?? [] as $index => $exp)
                            <div class="row mb-3 experience-entry">
                                <div class="col-md-4">
                                    <input required type="text" class="form-control" name="experience[{{ $index }}][post_hold]" value="{{ $exp['post_hold'] ?? '' }}" placeholder="Post Held">
                                </div>
                                <div class="col-md-4">
                                    <input required type="text" class="form-control" name="experience[{{ $index }}][from_year]" value="{{ $exp['from_year'] ?? '' }}" placeholder="From Year">
                                </div>
                                <div class="col-md-4">
                                    <input required type="text" class="form-control" name="experience[{{ $index }}][to_year]" value="{{ $exp['to_year'] ?? '' }}" placeholder="To Year">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-experience">Add More Experience</button>
                    </div>

                    <!-- Awards & Additional Details Tab -->
                    <div class="tab-pane fade" id="awards" role="tabpanel">
                        <h5 class="mt-4">Awards & Courses</h5>
                        <div id="awards-container">
                            @foreach ($LoggedSupervisorInfo->awards_courses ?? [] as $index => $award)
                            <div class="row mb-3 award-entry">
                                <div class="col-md-4">
                                    <input required type="text" class="form-control" name="awards_courses[{{ $index }}][title]" value="{{ $award['title'] ?? '' }}" placeholder="Title">
                                </div>
                                <div class="col-md-4">
                                    <input required type="text" class="form-control" name="awards_courses[{{ $index }}][year]" value="{{ $award['year'] ?? '' }}" placeholder="Year">
                                </div>
                                <div class="col-md-4">
                                    <input required type="text" class="form-control" name="awards_courses[{{ $index }}][organization]" value="{{ $award['organization'] ?? '' }}" placeholder="Organization">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-award">Add More Award/Course</button>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

            <script>
               document.addEventListener('DOMContentLoaded', function() {
    const educationContainer = document.getElementById('education-container');
    const experienceContainer = document.getElementById('experience-container');
    const awardsContainer = document.getElementById('awards-container');

    // Add Education
    document.getElementById('add-education').addEventListener('click', function() {
        const index = educationContainer.children.length;
        const newEducationEntry = `
            <div class="row mb-3 education-entry">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="education[${index}][degree]" placeholder="Degree" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="education[${index}][year]" placeholder="Year" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="education[${index}][university]" placeholder="University" required>
                </div>
            </div>`;
        educationContainer.insertAdjacentHTML('beforeend', newEducationEntry);
    });

    // Add Experience
    document.getElementById('add-experience').addEventListener('click', function() {
        const index = experienceContainer.children.length;
        const newExperienceEntry = `
            <div class="row mb-3 experience-entry">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="experience[${index}][post_hold]" placeholder="Post Held" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="experience[${index}][from_year]" placeholder="From Year" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="experience[${index}][to_year]" placeholder="To Year" required>
                </div>
            </div>`;
        experienceContainer.insertAdjacentHTML('beforeend', newExperienceEntry);
    });

    // Add Awards & Courses
    document.getElementById('add-award').addEventListener('click', function() {
        const index = awardsContainer.children.length;
        const newAwardEntry = `
            <div class="row mb-3 award-entry">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="awards_courses[${index}][title]" placeholder="Title" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="awards_courses[${index}][year]" placeholder="Year" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="awards_courses[${index}][organization]" placeholder="Organization" required>
                </div>
            </div>`;
        awardsContainer.insertAdjacentHTML('beforeend', newAwardEntry);
    });
});

            </script>
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