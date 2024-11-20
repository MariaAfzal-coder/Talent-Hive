<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup Form</title>

    <link rel="shortcut icon" href="../Studentdashboard/assets/images/logo.png" type="image/x-icon">

    <!---Custom CSS File--->
    <link rel="stylesheet" href="../AuthenticationStyling/style.css">
    <style></style>
</head>

<body>
    <div class="container">
        <div class="registration form">
        <div class="logo-container">
                <img src="../AuthenticationStyling/logo.png" alt="Talent Hive Logo">
                <h1>Talent Hive</h1>
            </div>
            <!-- Subheading -->
            <div class="subheading">
               Student Register
            </div>

            <form action="{{ route('student.save') }}" method="POST">
                @csrf <!-- Include CSRF token for form protection -->

                <div>
                    <input type="text" name="email" placeholder="Enter your email" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="text" name="sapid" placeholder="Enter your SapID" required>
                    @error('sapid')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password" placeholder="Create a password" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password_confirmation" placeholder="Confirm your password" required>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <input type="submit" class="button" value="Signup">
            </form>

            <div class="signup">
                <span class="signup">Already have an account?
                    <a href="/student/login">Login</a>
                </span>
            </div>
        </div>
    </div>
</body>

</html>
