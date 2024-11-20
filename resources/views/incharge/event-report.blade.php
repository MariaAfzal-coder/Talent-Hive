<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
    .container {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    h1 {
        color: #007bff;
        margin-bottom: 20px;
    }

    h2 {
        background-color: #1fd187;
        color: black;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
    }


    h4 {
        color: #1fd187;
        margin-bottom: 15px;
    }

    ul {
        list-style-type: disc;
        /* Use bullet points */
        padding-left: 20px;
        /* Indent list items */
    }

    li {
        margin: 15px 0;
        padding: 4px;
        border-radius: 5px;
        transition: background 0.3s;
        color: black;
        /* Black text for better visibility */
    }

    /* Different background colors for each section */
    .results {
        background-color: #1fd187;
        /* Bootstrap primary color */
    }

    .insights {
        background-color: #1fd187;
        /* Bootstrap success color */
    }

    .certification {
        background-color: #1fd187;
        /* Bootstrap warning color */
    }

    li:hover {
        opacity: 0.9;
        /* Slight hover effect */
    }

    .student-image {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .project-title {
        font-weight: bold;
        font-size: 1rem;
        /* Smaller font size */
    }

    .badge {
        background-color: #1fd187;
    }

    /* Print styles */
    @media print {
        .no-print {
            display: none;
            /* Hide elements with this class when printing */
        }

        .badge {
            background-color: #1fd187 !important;
            /* Ensure badge color is maintained */
        }

        h2 {
            background-color: #1fd187 !important;
            /* Ensure background color is printed */
            color: black !important;
            /* Keep text color black */
        }

        .results {
            background-color: #1fd187 !important;
            /* Maintain background color for results */
        }

        .insights {
            background-color: #1fd187 !important;
            /* Maintain background color for insights */
        }

        .certification {
            background-color: #1fd187 !important;
            /* Maintain background color for certification */
        }

        /* Additional styles to ensure good print layout */
        body {
            color: black !important;
            /* Ensure text color is black */
        }
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 style="background-color: ##1fd187;   ; color: black; padding: 10px; border-radius: 5px;">
            Event Report for {{ $event->event_name }}
        </h2>
        <br>
        <div class="row text-center mb-4">
            <div class="col">
                <h3 style="color: black;">Session: {{ $event->session }}</h3>
            </div>
            <div class="col">
                <h4 style="  color: black; ">Description: {{ $event->description }}</h4>
            </div>
            <div class="col">
                <h4 style="  color: black; ">Incharge: {{ $incharge->name ?? 'N/A' }}</h4>
            </div>
        </div>

        <div class="row text-center mb-4">
            <div class="col">
                <h3 class="section-title">Projects <span class="badge">{{ count($projectDetails) }}</span></h3>
            </div>
            <div class="col">
                <h3 class="section-title">Students <span class="badge">{{ $totalStudents }}</span></h3>
            </div>
            <div class="col">
                <h3 class="section-title">Companies <span class="badge">{{ $totalCompanies }}</span></h3>
            </div>
        </div>


        @if(count($projectDetails) > 0)
        <div class="list-group">
            @foreach($projectDetails as $project)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h5 class="project-title" style="font-size: 14px;">Project: {{ $project['title'] }}</h5>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex flex-wrap">
                                @foreach($project['members'] as $member)
                                <div class="d-flex align-items-center mr-2" style="font-size: 12px;">
                                    <img src="{{ $member->student->profile_image ? Storage::url($member->student->profile_image) : asset('Studentdashboard/assets/images/avatar.jpg') }}"
                                        alt="User" class="student-image rounded-circle"
                                        style="width: 30px; height: 30px;">
                                    <span class="ml-1">{{ $member->student->name ?? 'N/A' }}</span>
                                </div>
                                @endforeach
                                <span class="badge badge-info ml-2">Members: {{ count($project['members']) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center">No projects found for this event.</p>
        @endif

        <!-- Conclusion Section -->
        <div class="mt-5">
            <h2 class="results">Results</h2>
            <ul>
                <li>This event successfully brought together various stakeholders, resulting in a total of
                    {{ $totalStudents }} students participating across {{ count($projectDetails) }} projects, with the
                    involvement of {{ $totalCompanies }} companies. The collaboration fostered significant learning
                    opportunities and networking among participants.</li>
                <li>Companies involved in this event:
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        @foreach($companies as $company)
                        <span>{{ $company->name }}</span> <!-- Assuming the company has a 'name' attribute -->
                        @endforeach
                    </div>
                </li>
            </ul>


            <div class="mt-5">
                <h2 class="insights">Analytical Insights</h2>
                <ul>
                    <li>Attendance managed properly for students.</li>
                    <li>All registered students were present at the event.</li>
                    <li>All registered companies attended the event.</li>
                    <li>Total Hired Candidates: {{ $hiredCandidates }}</li>
                    <li>Total Interview In Progress Candidates: {{ $interviewInProgress }}</li>
                </ul>
                <h2 class="certification">Certification Information</h2>
                <ul>
                    <li>Total Certifications Awarded: {{ $certifiedStudents }}</li>
                    <li>Partial Completion Certificate issued to students in Part-1 (SDP-1).</li>
                    <li>Full Completion Certificate issued to students in Part-2 (SDP-2).</li>
                </ul>
                <h2 class="summary">Summary</h2>
                <p>@if($summary)
    <p>{{ $summary }}</p>
@else
    <p>No summary available.</p>
@endif
</p>
            </div>

        </div>

        <div class="text-center mt-4 no-print">
            <button class="btn" style="background-color:#1fd187;" onclick="window.print();">Print Report</button>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>

</html>