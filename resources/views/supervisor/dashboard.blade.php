<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supervisor Home - TalentHive</title>
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


        <!-- Page Content -->
        <div class="container-fluid pc-gutter mt-4 pb-4">
      <h1 class="mb-3 fs-4 fw-semibold">Home</h1>

      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <div class="card h-100">
            <div class="card-body">
              <h6 class="text-xl fw-semibold flex-shrink-0 mb-3">Project</h6>
              <div class="project-image">
                <img src="../Supervisordashboard/assets/images/plant-app-project.png" alt="plant app" class="img-fluid rounded rounded-3">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <h6 class="text-xl fw-semibold flex-shrink-0 mb-3">Status Tracking</h6>
              <div class="hstack gap-2 h-100 align-self-center">
                <a href="/supervisor/statustracking" class="btn btn-success-emphasis btn-lg"><img src="./assets/images/icon/plus.svg" alt="" width="24" height="24" class="inject-svg"> View Status</a>
              </div>
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