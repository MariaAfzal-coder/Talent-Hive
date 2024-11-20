<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <title>Signup Page - Talent Hive</title>
    <style>
    body,
    html {
        height: 100%;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f4f4f4;
        font-family: Arial, sans-serif;
    }

    .container {
        text-align: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        position: relative;
        /* Enable positioning for the home icon */
    }

    .header {
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .button-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .row {
        display: flex;
        gap: 15px;
    }

    .button-container button {
        width: 180px;
        padding: 10px;
        font-size: 18px;
        color: #fff;
        background-color: #1fd187;
        /* Green color */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button-container button:hover {
        background-color: #5bf5ba;
        /* Lighter green on hover */
    }

    /* Style for the home icon */
    .home-icon {
        position: absolute;
        top: 10px;
        left: 10px;
    }

    .home-icon img {
        width: 30px;
        height: 30px;
        cursor: pointer;
    }
    </style>
</head>

<body>

    <!-- Branding Title at the top -->
 
    

    <body>
        <div class="container">
            <!-- Home icon -->
            <div class="home-icon">
                <a href="{{ route('home') }}">
                <i class="fas fa-home fa-2x me-2" style="color: #28a745;"></i>
                </a>
            </div>

            <div class="header">
                <h1>Log in As:</h1>
            </div>
            <div class="button-container">
                <div class="row">
                    <button onclick="openForm('/incharge/login')">INCHARGE</button>
                    <button onclick="openForm('/company/login')">COMPANY</button>
                </div>
                <div class="row">
                    <button onclick="openForm('/supervisor/login')">SUPERVISOR</button>
                    <button onclick="openForm('/student/login')">STUDENTS</button>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        function openForm(page) {
            window.location.href = page;
        }
        </script>


    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function openForm(page) {
        window.location.href = page;
    }
    </script>
</body>

</html>