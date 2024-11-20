<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificate - TalentHive</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
  <link href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .certificate-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: white;
      text-align: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
    }
    .certificate-image {
      width: 100%; /* Adjust to your desired width */
      max-width: 600px;
      height: auto;
      margin-top: 20px;
    }
    .arrow-container {
    position: absolute;
    top: 20px; /* Adjust to position vertically */
    left: 230px; /* Align to the left edge */
}

.back-icon {
    text-decoration: none;
    font-size: 24px; /* Arrow size */
    color: #007bff;
}
.custom-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

.custom-button:hover {
    background-color: #0056b3;
}
    h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }
    .student-info {
      font-size: 18px;
      margin: 10px 0;
      display: flex;
      justify-content: center;
      gap: 20px; /* Space between items */
    }
    .print-button {
      margin-top: 20px;
    }
    @media print {
      .print-button {
        display: none; /* Hide the button when printing */
      }
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="certificate-container">
    <div class="arrow-container">
    <a href="incharge/certificaiton" class="back-icon">

        <i class="fas fa-arrow-left"></i>
    </a>
   </div>
      <h1>Certificate of Completion</h1>
      <div class="student-info">
        <span>{{ $name }}</span>
        <span>SAP ID: {{ $sapid }}</span>
        <span>SDP: {{ $sdp }}</span>
      </div>

      @php
          $certificateImage = $sdp === 'Part-1' ? asset('../Inchargedashboard/assets/images/sdp1.png') : asset('../Inchargedashboard/assets/images/sdp2.png');
      @endphp

      <img src="{{ $certificateImage }}" alt="Certificate" class="certificate-image">
<br><br>
      <button class="custom-button " onclick="printCertificate()">Print Certificate</button>


    </div>
  </div>

  <script>
    function printCertificate() {
      window.print();
    }
  </script>
</body>
</html>
