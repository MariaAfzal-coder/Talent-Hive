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
            <h1 class="mb-3 fs-4 fw-semibold">Home</h1>

            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body my-5">
                            <div class="logo text-center mb-4">
                                <img src="../Companydashboard/assets/images/logo.png" alt="logo" width="100">
                            </div>
                            <h1 class="text-center">WELCOME TO TALENT HIVE</h1>
                            <p class="text-center fs-4 mb-0">Discover Connect Thrive</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <a href="/company/project" class="text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="text-xl fw-semibold flex-shrink-0 mb-3">Project</h6>
                                <div class="project-image">
                                    <img src="../Companydashboard/assets/images/plant-app-project.png" alt="plant app"
                                        class="img-fluid rounded rounded-3">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-6">
                    <a href="/company/hiringcandidate" class="text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="text-xl fw-semibold flex-shrink-0 mb-3">Hiring Candidates</h6>

                    </a>






                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-secondary">Candidate</th>
                                    <th scope="col" class="text-secondary">Skills</th>
                                    <th scope="col" class="text-secondary">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Asma Ali</td>
                                    <td>Python, Java</td>
                                    <td>
                                        <select>
                                            <option value="hired" selected>Hired</option>
                                            <option value="not_hired">Not Hired</option>
                                            <option value="intervire_inprocess">Interview Inprocess</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Asma Ali</td>
                                    <td>Python, Java</td>
                                    <td>
                                        <select>
                                            <option value="hired" selected>Hired</option>
                                            <option value="not_hired">Not Hired</option>
                                            <option value="intervire_inprocess">Interview Inprocess</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Asma Ali</td>
                                    <td>Python, Java</td>
                                    <td>
                                        <select>
                                            <option value="hired" selected>Hired</option>
                                            <option value="not_hired">Not Hired</option>
                                            <option value="intervire_inprocess">Interview Inprocess</option>

                                        </select>
                                    </td>
                                </tr>
                                <!-- <tr>
                      <td>Asma Ali</td>
                      <td>Python, Java</td>
                      <td>
                        <select></select>
                          <option value="hired" selected>Hired</option>
                          <option value="not_hired">Not Hired</option>
                          <option value="intervire_inprocess">Interview Inprocess</option>

                        </select>
                      </td>
                    </tr> -->
                            </tbody>
                        </table>
                    </div>
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