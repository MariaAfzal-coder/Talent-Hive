<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home - TalentHive</title>
    <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Studentdashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Studentdashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Studentdashboard/assets/css/style.css">

    <!-- Include SweetAlert from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <div class="container-fluid pc-gutter mt-4 pb-4">
            <h1 class="mb-3 fs-4 fw-semibold">CV Creation</h1>

            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <form id="cv-form" action="{{ route('student.cv.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                @if(isset($cv->image))
                                    <img src="{{ asset('storage/' . $cv->image) }}" alt="CV Image" class="img-thumbnail mt-2" style="width: 100px; height: 100px;">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $cv->name ?? '') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">Profile:</label>
                            <textarea class="form-control" id="profile" name="profile" rows="3" required>{{ old('profile', $cv->profile ?? '') }}</textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $cv->phone ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $cv->email ?? '') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $cv->address ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="additional-info" class="form-label">Additional Information:</label>
                            <textarea class="form-control" id="additional-info" name="additional-info" rows="2">{{ old('additional-info', $cv->additional_info ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="education" class="form-label">Education:</label>
                            <textarea class="form-control" id="education" name="education" rows="3" required>{{ old('education', $cv->education ?? '') }}</textarea>
                        </div>

                        <!-- Skills Section -->
                        <div class="mb-3">
                            <label for="skillsUsed" class="form-label">Skills </label>
                            <button type="button" id="addSkill" class="btn btn-link">+</button>
                            <div id="skillsContainer">
                                @if(isset($cv->skills))
                                    @foreach(json_decode($cv->skills, true) as $skill)
                                        <input type="text" class="form-control mb-2" name="skillsUsed[]" placeholder="Skill Used" value="{{ $skill }}">
                                    @endforeach
                                @else
                                    <input type="text" class="form-control mb-2" name="skillsUsed[]" placeholder="Skill Used">
                                @endif
                            </div>
                        </div>

                        <!-- Languages Section -->
                        <div class="mb-3">
                            <label for="languageUsed" class="form-label">Languages </label>
                            <button type="button" id="addLanguage" class="btn btn-link">+</button>
                            <div id="languageContainer">
                                @if(isset($cv->languages))
                                    @foreach(json_decode($cv->languages, true) as $language)
                                        <input type="text" class="form-control mb-2" name="languageUsed[]" placeholder="Language Used" value="{{ $language }}">
                                    @endforeach
                                @else
                                    <input type="text" class="form-control mb-2" name="languageUsed[]" placeholder="Language Used">
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="work-experience" class="form-label">Work Experience:</label>
                            <textarea class="form-control" id="work-experience" name="work-experience" rows="4" required>{{ old('work-experience', $cv->work_experience ?? '') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('student.cv.export') }}" class="btn btn-secondary">Export to PDF</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

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
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
            @endif
        });
    </script>

    <!-- Bootstrap JS and other JS -->
    <script src="../Studentdashboard/assets/js/svg-injector.min.js"></script>
    <script src="../Studentdashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../Studentdashboard/assets/js/main.js"></script>
</body>

</html>
