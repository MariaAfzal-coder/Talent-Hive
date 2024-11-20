<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Attendance Report for {{ $selectedEventDetails->name }}</h1>
<h2>Session: {{ $selectedEventDetails->session }}</h2>

<table>
    <thead>
        <tr>
            <th>Student Name</th>
            <th>SAP ID</th>
            <th>Project</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->sapid }}</td>
            <td>
                @foreach ($student->projects as $project)
                    <span class="badge bg-primary me-1">{{ $project->title }}</span>
                @endforeach
                <span>{{ $student->sdp }}</span>
            </td>
            <td>{{ isset($attendanceMap[$student->id]) ? $attendanceMap[$student->id] : 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
