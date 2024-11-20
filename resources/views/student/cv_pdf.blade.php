<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student CV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #1E90FF;
        }
        .cv-section {
            margin-bottom: 20px;
        }
        .cv-section h2 {
            border-bottom: 2px solid #1E90FF;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .cv-section p {
            margin: 0;
        }
        .profile-picture {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .contact-info {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Talent Hive</h1>
    </div>

    <!-- Profile Picture Section -->
    <div class="profile-picture">
        @if($cv->image)
            <img src="{{ public_path('storage/' . $cv->image) }}" alt="{{ $cv->name }}">
        @else
            <p>No image available</p>
        @endif
    </div>

    <!-- Student Name -->
    <div class="header">
        <h2>{{ $cv->name }}</h2>
    </div>

    <!-- Profile Section -->
    <div class="cv-section">
        <h2>Profile</h2>
        <p>{{ $cv->profile }}</p>
    </div>

    <!-- Contact Information Section -->
    <div class="cv-section">
        <h2>Contact Information</h2>
        <p><strong>Email:</strong> {{ $cv->email }}</p>
        <p><strong>Phone:</strong> {{ $cv->phone }}</p>
        <p><strong>Address:</strong> {{ $cv->address }}</p>
    </div>

    <!-- Work Experience Section -->
    <div class="cv-section">
        <h2>Work Experience</h2>
        <p>{{ $cv->work_experience }}</p>
    </div>

    <!-- Education Section -->
    <div class="cv-section">
        <h2>Education</h2>
        <p>{{ $cv->education }}</p>
    </div>

    <!-- Skills Section -->
    <div class="cv-section">
        <h2>Skills</h2>
        <ul>
            @foreach(json_decode($cv->skills, true) as $skill)
                <li>{{ $skill }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Languages Section -->
    <div class="cv-section">
        <h2>Languages</h2>
        <ul>
            @foreach(json_decode($cv->languages, true) as $language)
                <li>{{ $language }}</li>
            @endforeach
        </ul>
    </div>

    <div class="contact-info">
        <p>Thank you for reviewing {{ $cv->name }}'s CV.</p>
    </div>
</body>
</html>
