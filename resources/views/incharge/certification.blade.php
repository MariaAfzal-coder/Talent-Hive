<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - TalentHive</title>
    <link rel="shortcut icon" href="../Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../Inchargedashboard/assets/images/logo.png" type="image/x-icon">
    <link href="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="../Inchargedashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Inchargedashboard/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Inchargedashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Inchargedashboard/assets/css/style.css">
</head>

<body>
    @include('incharge.includes.sidebar')


    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('incharge.includes.navbar')

        <!-- Page Content -->
        <div class="container-fluid pc-gutter mt-4">
            <div class="row g-3 mb-3">
                <div class="col-sm-12">
                    <h1 class="mb-0 fs-4 fw-semibold">Electronic Certification</h1>
                    <br>
                    <div>
                        <button class="btn btn-primary" id="sdp1Button">SDP 1</button>
                        <button class="btn btn-secondary" id="sdp2Button">SDP 2</button>
                    </div>
                </div>
            </div>

            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                    <div class="vstack gap-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="fs-5 mb-3 fw-semibold">Students</h3>
                                <div class="mt-3">
                                    <table class="table table-bordered" id="studentsTable">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th> SapId</th>
                                                <th>SDP </th>

                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="studentsBody">
                                            @foreach ($students as $student)
                                            <tr class="student-row" data-sdp="{{ $student->sdp }}">
                                                <td>
                                                    @if($student->profile_image)
                                                    <img src="{{ Storage::url($student->profile_image) }}" height="40"
                                                        width="40" class="rounded-circle me-2">
                                                    @else
                                                    <img src="../Inchargedashboard/assets/images/avatar.jpg" height="40"
                                                        width="40" alt="Default Avatar" class="rounded-circle me-2">
                                                    @endif
                                                    <span contenteditable="true">{{ $student->name }}</span>
                                                </td>
                                                <td contenteditable="true">{{ $student->sapid }}</td>
                                                <td contenteditable="true">{{ $student->sdp }}</td>

                                                <td>
    <form action="{{ route('generate.certificate') }}" method="POST" class="d-inline">
        @csrf
        <input type="hidden" name="name" value="{{ $student->name }}">
        <input type="hidden" name="sapid" value="{{ $student->sapid }}">
        <input type="hidden" name="sdp" value="{{ $student->sdp }}">
        <button type="submit" class="btn btn-primary btn-sm">Generate Certificate</button>
    </form>
</td>

                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
 
        <script>
        document.getElementById('sdp1Button').addEventListener('click', function() {
            filterStudents('Part-1');
        });

        document.getElementById('sdp2Button').addEventListener('click', function() {
            filterStudents('Part-2');
        });

        function filterStudents(sdp) {
            const rows = document.querySelectorAll('.student-row');
            rows.forEach(row => {
                if (row.getAttribute('data-sdp') === sdp) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        }
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


        <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="assets/js/svg-injector.min.js"></script>
        <script src="../Inchargedashboard/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="../Inchargedashboard/assets/js/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>




        <!-- Bootstrap JS and Popper.js -->
        <script src="../Inchargedashboard/assets/js/svg-injector.min.js"></script>
        <script src="../Inchargedashboard/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="../Inchargedashboard/assets/js/main.js"></script>
</body>

</html>