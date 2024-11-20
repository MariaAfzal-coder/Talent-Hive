<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report - TalentHive</title>
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
    <style>
    .form-container {
      max-width: 600px;
      /* Adjust the max width to keep fields aligned */
      margin: auto;
      background-color: white;
      /* White background */
      padding: 70px;
      /* Padding inside the container */
      border-radius: 10px;
      /* Rounded corners */
      box-shadow: 0 5px 9px rgba(0, 0, 0, 0.1);
      /* Optional: adds a subtle shadow */
    }

    .btn-teal {
      background-color: rgb(23, 143, 223);
      color: white;
      border: none;
    }

    .btn-teal:hover {
      background-color: rgb(15, 209, 223);
      color: white;
    }
  </style>
    <link rel="stylesheet" href="../Inchargedashboard/assets/css/font.css">
    <link rel="stylesheet" href="../Inchargedashboard/assets/css/style.css">
</head>

<body>
    <div class="dim-background" id="dimBackground"></div>

    <!-- Sidebar -->
    @include('incharge.includes.sidebar')


    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        @include('incharge.includes.navbar')
        <!-- Page Content -->
        <div class="container-fluid pc-gutter mt-4 pb-4">
            <div class="form-container">

                <div class="hstack justify-content-between gap-2 mb-3">
                    <h1 class="mb-0 fs-4 fw-semibold">Generate Full Report</h1>
                </div>
                <form action="{{ route('incharge.generate.report') }}" method="get">
    @csrf
    <div class="mb-3">
        <label for="session" class="form-label">Select Session:</label>
        <select class="form-select" id="session" name="session" required>
            <option value="" disabled selected>Select Session</option>
            @foreach($sessionsWithEvents as $session)
                <option value="{{ $session->event_id }}">
                    {{ $session->session }} <!-- Only show session name -->
                </option>
            @endforeach
        </select>
    </div>

    <!-- Hidden field for summary -->
    <input type="hidden" name="summary" id="summaryInputHidden">

    <button type="submit" class="btn btn-teal" id="generateReportBtn">Generate Report</button>
</form>
<!-- Modal for entering Summary -->
<div class="modal fade" id="summaryModal" tabindex="-1" aria-labelledby="summaryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="summaryModalLabel">Enter Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea id="summaryInput" class="form-control" rows="4" placeholder="Enter your summary..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSummaryBtn">Proceed To Report</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap's JS and Popper.js (if not already included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Listen for session selection and open the modal
    document.getElementById('generateReportBtn').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent form submission

        var sessionId = document.getElementById('session').value;

        // If a session is selected, show the modal to enter summary
        if (sessionId) {
            var summaryModal = new bootstrap.Modal(document.getElementById('summaryModal'));
            summaryModal.show();
        }
    });

    // Save the summary when the user clicks "Save Summary"
    document.getElementById('saveSummaryBtn').addEventListener('click', function() {
        var summaryText = document.getElementById('summaryInput').value;

        // If there's summary text, set it in the hidden input
        if (summaryText) {
            document.getElementById('summaryInputHidden').value = summaryText;
        }

        // Close the modal
        var summaryModal = new bootstrap.Modal(document.getElementById('summaryModal'));
        summaryModal.hide();

        // Submit the form after saving the summary
        document.querySelector('form').submit();
    });
</script>




            </div>
        </div>

    </div>
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