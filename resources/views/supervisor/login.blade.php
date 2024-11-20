<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
    <!---Custom CSS File--->  <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../AuthenticationStyling/style.css">
    <style>
        .back-icon {
    font-size: 24px; /* Size of the icon */
    color: #007bff; /* Icon color */
    text-decoration: none; /* Remove underline */
}

.back-icon:hover {
    color: #0056b3; /* Darker color on hover */
}
        </style>

    
</head>

<body>
    <div class="container">
        <div class="form">
            <!-- Logo and Heading Section -->
            <a href="../mainpage" class="back-icon">
                <i class="fas fa-arrow-left"></i>
               </a>
            <div class="logo-container">
                <img src="../AuthenticationStyling/logo.png" alt="Talent Hive Logo">
                <h1>Talent Hive</h1>
            </div>
            <!-- Subheading -->
            <div class="subheading">
            Supervisor Login
            </div>
            @if(session('message'))
                <div class="alert text-success">
                    {{ session('message') }}
                </div>
            @endif
            @if(session('error'))
    <div class="alert text-danger alert-danger">
        {{ session('error') }}
    </div>
@endif

            <!-- Login Form -->
            <form action="{{ route('supervisor.check') }}" method="POST">
    @csrf <!-- Include CSRF token for form protection -->
    
    <input type="text" name="email" placeholder="Enter your email" required>
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <input type="password" name="password" placeholder="Enter your password" required>
    @error('password')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <input type="submit" class="button" value="Login">

   
</form>



            <!-- Signup Redirect -->
            <div class="signup">
                <span>Don't have an account?
                    <a href="/supervisor/register">Register</a>
                </span>
            </div>
        </div>
    </div>
</body>

</html>
