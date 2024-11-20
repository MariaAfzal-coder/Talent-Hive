<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Storage;
use App\Models\Event;
 use App\Http\Controllers\Controller;
use App\Models\Student; 
use App\Models\Users\User;
use App\Models\Part; // Add this at the top
use App\Models\Fault; // Add this at the top
use App\Models\Project;
use App\Models\Company;
use App\Models\InterviewSchedule;

use App\Models\EventProject;
use App\Models\ProjectMember;

use App\Models\StudentEventAttendance;

use App\Models\Incharge;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB;
class InchargeController extends Controller
{ 
    
    public function destroy($event_id, $project_id)
    {
        // Assuming 'event_project' is the name of the pivot table
        $deleted = DB::table('event_project')
                    ->where('event_id', $event_id)
                    ->where('project_id', $project_id)
                    ->delete();
    
        if ($deleted) {
            return redirect()->back()->with('success', 'Project removed from event successfully.');
        }
        
        return redirect()->back()->with('error', 'Project not found in this event.');
    }
    

    
    public function store(Request $request)
    {
        // Retrieve the logged-in incharge's ID from the session
        $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
    
        // Check if the incharge is logged in
        if (!$LoggedInchargeInfo) {
            return redirect()->route('incharge.login')->with('error', 'You must be logged in to access the dashboard.');
        }
    
        // Validate form data
        $request->validate([
            'event_name' => 'required|string|max:255',
            'session' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
            'projects' => 'required|array',
        ]);
    
        // Create the event with the incharge_id
        $event = Event::create([
            'event_name' => $request->event_name,
            'session' => $request->session,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'incharge_id' => $LoggedInchargeInfo->id, // Use the incharge ID from the session
        ]);
    
        // Attach selected projects to the event
        foreach ($request->projects as $projectId) {
            DB::table('event_project')->insert([
                'event_id' => $event->id,
                'project_id' => $projectId,
            ]);
        }
    
        return redirect()->back()->with('success', 'Event created successfully and projects added.');
    }
    
        
         
        
      
    public function attendence(Request $request)
    {
        // Retrieve the logged-in incharge's ID from the session
        $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
    
        // Check if the incharge is logged in
        if (!$LoggedInchargeInfo) {
            return redirect()->route('incharge.login')->with('error', 'You must be logged in to access the dashboard.');
        }
    
        // Fetch all events related to the logged-in incharge
        $events = Event::where('incharge_id', $LoggedInchargeInfo->id)->get();
    
        // Fetch all students
        $students = Student::with('projects')->get();
    
        // Initialize attendance map
        $attendanceMap = [];
    
        // Initialize selected event details
        $selectedEventDetails = null;
    
        // Check if an event ID was provided in the request
        if ($request->has('event_id')) {
            $eventId = $request->input('event_id');
    
            // Fetch attendance records for the selected event
            $attendanceRecords = StudentEventAttendance::where('event_id', $eventId)->get();
    
            // Map attendance records to students
            foreach ($attendanceRecords as $record) {
                $attendanceMap[$record->student_id] = $record->status;
            }
    
            // Retrieve the selected event name
            $selectedEvent = Event::find($eventId);
            if ($selectedEvent) {
                $selectedEventDetails = [
                    'name' => $selectedEvent->event_name,
                    'session' => $selectedEvent->session,
                ];
            }
        }
    
        // Pass the incharge info, events, students, attendance map, and selected event details to the view
        return view('incharge.attendence', [
            'LoggedInchargeInfo' => $LoggedInchargeInfo,
            'events' => $events,
            'students' => $students,
            'attendanceMap' => $attendanceMap, // Pass attendance status if available
            'selectedEventDetails' => $selectedEventDetails, // Pass the selected event details
        ]);
    }
    
     
    
    
    public function saveAttendance(Request $request)
    {
        // Validate the request
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'attendance' => 'required|array',
            'attendance.*.status' => 'required|in:Present,Absent',
        ]);
    
        // Retrieve the incharge ID
        $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
        if (!$LoggedInchargeInfo) {
            return redirect()->route('incharge.login')->with('error', 'You must be logged in to save attendance.');
        }
    
        // Get the event ID from the request
        $eventId = $request->input('event_id');
        $attendanceData = $request->input('attendance'); // attendance[student_id][status]
    
        // Iterate over each student's attendance status
        foreach ($attendanceData as $studentId => $data) {
            // Check if the student already has an attendance record for this event
            $existingAttendance = \App\Models\StudentEventAttendance::where('event_id', $eventId)
                ->where('student_id', $studentId)
                ->first();
    
            if ($existingAttendance) {
                // Update existing record
                $existingAttendance->update([
                    'status' => $data['status'],
                    'incharge_id' => $LoggedInchargeInfo->id,
                ]);
            } else {
                // Create a new attendance record
                \App\Models\StudentEventAttendance::create([
                    'event_id' => $eventId,
                    'student_id' => $studentId,
                    'incharge_id' => $LoggedInchargeInfo->id,
                    'status' => $data['status'],
                ]);
            }
        }
    
        return redirect()->route('incharge.attendence')->with('success', 'Attendance saved successfully.');
    }
    
    public function events()
{
    // Retrieve the logged-in incharge's ID from the session
    $inchargeId = session('LoggedInchargeInfo');

    // Check if the incharge ID exists in the session
    if (!$inchargeId) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    // Find the incharge using the ID
    $LoggedInchargeInfo = Incharge::find($inchargeId);

    // If incharge doesn't exist (just in case)
    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'Incharge not found.');
    }

    // Retrieve all projects for display
    $projects = Project::all();

    // Get current date
    $today = \Carbon\Carbon::today();

    // Retrieve events for the logged-in incharge, ordered by creation date (latest first)
    $events = Event::where('incharge_id', $inchargeId)
        ->orderBy('created_at', 'desc') // Order by created_at descending
        ->paginate(3);

    // Loop through the events and check the end_date
    foreach ($events as $event) {
        // If the event's end date is today or has passed and the status is not yet "Completed"
        if (\Carbon\Carbon::parse($event->end_date)->lessThanOrEqualTo($today) && $event->status != 'Completed') {
            // Update the status to "Completed"
            $event->status = 'Completed';
            $event->save();
        }
    }

    $inProgressEvent = Event::where('incharge_id', $inchargeId)
        ->where('status', 'In Progress')
        ->first();

    // Pass the logged-in incharge info, projects, and events to the view
    return view('incharge.events', [
        'LoggedInchargeInfo' => $LoggedInchargeInfo,
        'projects' => $projects,
        'events' => $events,
        'inProgressEvent' => $inProgressEvent // This will indicate if there’s an "In Progress" event
    ]);
}

public function certification()
{
    // Retrieve the logged-in incharge ID
    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to save attendance.');
    }

    // Retrieve all students
    $students = Student::all(); // Adjust this if you have a specific model or condition

    // Pass the logged-in incharge info and all students to the view
    return view('incharge.certification', [
        'LoggedInchargeInfo' => $LoggedInchargeInfo,
        'students' => $students,
    ]);
}
public function report(Request $request)
{
    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to save attendance.');
    }

    // Get all sessions with their associated events
    $sessionsWithEvents = Event::select('session', 'id as event_id')->distinct()->get();

    return view('incharge.report', [
        'LoggedInchargeInfo' => $LoggedInchargeInfo,
        'sessionsWithEvents' => $sessionsWithEvents,
    ]);
}public function generateReport(Request $request)
{
    $request->validate([
        'session' => 'required|integer|exists:events,id', // Validate session as the event ID
        'summary' => 'nullable|string', // Validate summary if provided
    ]);

    // Get the selected event using the session (which is the event ID)
    $event = Event::find($request->session);

    // Check if the event was found
    if (!$event) {
        // Handle the case where the event is not found
        return redirect()->back()->with('error', 'Event not found');
    }

    // Fetch the companies for the event
    $companies = Company::all(); // Get all companies (you can adjust this as needed)
    $totalCompanies = $companies->count();

    // Fetch associated projects
    $projects = EventProject::where('event_id', $event->id)->get();
    $incharge = Incharge::find($event->incharge_id);

    $projectDetails = [];
    $totalStudents = 0; // Initialize total students counter

    foreach ($projects as $project) {
        // Eager load members and their students
        $members = ProjectMember::with('student')->where('project_id', $project->project_id)->get();
        $projectDetails[] = [
            'project_id' => $project->project_id,
            'title' => $project->project->title ?? 'N/A', // Assuming 'name' is the correct attribute
            'members' => $members,
        ];
        // Count the number of members and add to total
        $totalStudents += count($members);
    }

    // Get the total count of "Hired" and "Interview In Progress" candidates
    $hiredCandidates = InterviewSchedule::where('status', 'Hired')->count();
    $interviewInProgress = InterviewSchedule::where('status', 'interview_inprocess')->count();

    $certifiedStudents = Student::where('certification_status', 'awarded')->count();

    // Pass the event, companies, and other data to the view
    return view('incharge.event-report', [
        'event' => $event,
        'totalCompanies' => $totalCompanies,
        'companies' => $companies, // Pass companies to the view
        'incharge' => $incharge,
        'projectDetails' => $projectDetails,
        'totalStudents' => $totalStudents, // Pass total students to the view
        'hiredCandidates' => $hiredCandidates, // Pass hired candidates count
        'interviewInProgress' => $interviewInProgress, // Pass interview in progress count
        'certifiedStudents' => $certifiedStudents,  // Pass the count of awarded certifications
        'summary' => $request->summary,  // Pass summary to the view
    ]);
}



public function statustracking()
{
    // Retrieve the logged-in in-charge ID
    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to access this page.');
    }

    // Retrieve events created by the logged-in in-charge and load associated projects
    $projects = Event::with(['projects' => function($query) {
                        $query->select('id', 'title', 'status', 'image', 'ending_date', 'abstract', 
                                       'student_id', 'languages', 'supervised_by', 'video_url', 
                                       'created_at', 'updated_at', 'progress');
                    }])
                   ->where('incharge_id', $LoggedInchargeInfo->id)
                   ->get(['id', 'event_name', 'session', 'start_date', 'end_date', 
                          'description', 'incharge_id', 'created_at', 'updated_at', 'status']);
//dd($projects);
    return view('incharge.statustracking', [
        'LoggedInchargeInfo' => $LoggedInchargeInfo,
        'projects' => $projects,
    ]);
}

public function profile()
{
    
   // Retrieve the logged-in student's ID from the session
   // Retrieve the incharge ID
   $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
   if (!$LoggedInchargeInfo) {
       return redirect()->route('incharge.login')->with('error', 'You must be logged in to save attendance.');
   }
   // Pass the logged-in student info to the dashboard view
   return view('incharge.profile', [
       'LoggedInchargeInfo' => $LoggedInchargeInfo,
   ]);
 }   

 public function editprofile()
 {
     
    // Retrieve the logged-in student's ID from the session
    // Retrieve the incharge ID
    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to save attendance.');
    }
    // Pass the logged-in student info to the dashboard view
    return view('incharge.editprofile', [
        'LoggedInchargeInfo' => $LoggedInchargeInfo,
    ]);
  }   
  public function makeprofile()
 {
     
    
    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to save attendance.');
    }
     return view('incharge.makeprofile', [
        'LoggedInchargeInfo' => $LoggedInchargeInfo,
    ]);
  }  
 
  public function viewcv($id)
{
    $student = Student::with('cv')->findOrFail($id); // Eager load the CV relationship
    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));

    // Check if the company is logged in
    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    return view('incharge.viewcv', compact('student', 'LoggedInchargeInfo'));
}
 
 public function updateProfile(Request $request)
 {
     // Validate the request
     $request->validate([
         'name' => 'nullable|string|max:255',
          'phone' => 'nullable|string|max:20|regex:/^\+?[0-9\s]*$/', // Validate phone number format
         'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
     ]);
 
     // Find the logged-in incharge
     $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
     if (!$LoggedInchargeInfo) {
         return redirect()->route('incharge.login')->with('error', 'You must be logged in to save attendance.');
     }
 
     // Update the incharge's information
     $LoggedInchargeInfo->name = $request->name;
  
     // Update the phone number if provided
     if ($request->filled('phone')) {
         $LoggedInchargeInfo->phone = $request->phone;
     }
 
     // Handle profile image upload if provided
     if ($request->hasFile('profile_image')) {
         // Optionally, you can delete the old image if necessary
         // Storage::delete($LoggedInchargeInfo->profile_image); // Uncomment if you want to delete old image
         
         // Store the new profile image
         $LoggedInchargeInfo->profile_image = $request->file('profile_image')->store('profile_images', 'public');
     }
 
     // Save the updated incharge information
     $LoggedInchargeInfo->save();
 
     // Redirect back to the profile page with a success message
     return redirect()->route('incharge.profile')->with('message', 'Profile updated successfully.');
 }
 
        
    function projects()
    {

       // Retrieve the logged-in incharge's ID from the session
    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));

    // Check if the incharge is logged in
    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to access the dashboard.');
    }
    $projects = Project::paginate(3);

    // Pass the logged-in incharge info and projects to the view
    return view('incharge.projects', [
        'LoggedInchargeInfo' => $LoggedInchargeInfo,
        'projects' => $projects,
    ]);
    // Pass the logged-in incharge info to the dashboard view
   
     }
            
            
             
            function login()
            {
                return view('incharge.login');
            }
            
        
            function register()
            {
                return view('incharge.register');
            }
        
        
        
        
        
            public function check(Request $request)
            {
                // Validate the input
                $request->validate([
                    'email' => 'required|email',
                    'password' => 'required|min:5|max:12'
                ]);
            
                // Attempt to find the incharge by email
                $inchargeInfo = Incharge::where('email', $request->email)->first();
            
                // Check if the incharge exists
                if (!$inchargeInfo) {
                    return back()->withInput()->withErrors(['email' => 'Email not found']);
                }
            
                // Check the password
                if (!Hash::check($request->password, $inchargeInfo->password)) {
                    return back()->withInput()->withErrors(['password' => 'Incorrect password']);
                }
            
                // Set session for the logged-in incharge
                session(['LoggedInchargeInfo' => $inchargeInfo->id]);
            
                // Redirect to the incharge dashboard or a desired route
                return redirect()->route('incharge.dashboard')->with('message', 'Login successful!');
            }
            
            
        
        
        
            public function logout()
{
    // Check if the incharge is logged in
    if (session()->has('LoggedInchargeInfo')) {
        // Forget the logged-in incharge session
        session()->forget('LoggedInchargeInfo');
    }

    // Redirect to the incharge login page with a success message
    return redirect()->route('incharge.login')->with('message', 'You have been logged out successfully.');
}

            
// In your Controller (adjust as necessary)
public function dashboard()
{
    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));

    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    // Fetch data for projects with correct grouping
    $projectsData = Project::select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get();

    // Fetch data for events with correct grouping
    $eventsData = Event::select('id', 'event_name', DB::raw('MONTH(start_date) as month'), DB::raw('count(*) as count'))
        ->groupBy('id', 'event_name', 'month')
        ->get();
        $eventProjectCounts = EventProject::select('event_project.event_id', 'events.event_name', DB::raw('count(event_project.project_id) as project_count'))
        ->join('events', 'event_project.event_id', '=', 'events.id') // Join with events table using event_id
        ->groupBy('event_project.event_id', 'events.event_name') // Group by event_id and event_name
        ->get()
        ->map(function ($item) {
            return [
                'event_id' => $item->event_id,
                'event_name' => $item->event_name, // Add event name
                'project_count' => $item->project_count
            ];
        });
    

//dd($eventProjectCounts);
    // Debugging to check the structure
 
    // Prepare data for the frontend (make sure to pass projects and events data)
    return view('incharge.dashboard', [
        'LoggedInchargeInfo' => $LoggedInchargeInfo,
        'projectsData' => $projectsData,
        'eventsData' => $eventsData,
        'eventProjectCounts' => $eventProjectCounts
    ]);
}

 
 
public function show($id)
{


    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));

    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to access the dashboard.');
    }
    // Find the project by ID
    $project = Project::findOrFail($id);

    // Pass the project data to the view
    return view('incharge.detail', compact('project','LoggedInchargeInfo')); // Adjust view name as needed
}
public function getProjectsByEvent($eventId)
{
    try {
        Log::info("Fetching projects for event ID: {$eventId}");
        
        $event = Event::find($eventId);
        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        // Log the query and check if the result is correct
        $projects = Project::join('event_project', 'projects.id', '=', 'event_project.project_id')
            ->where('event_project.event_id', $eventId)
            ->get(['projects.id', 'projects.title', 'projects.status', 'projects.start_date', 'projects.end_date']);
        
        Log::info("Projects data fetched: ", $projects->toArray());

        if ($projects->isEmpty()) {
            return response()->json(['message' => 'No projects found for this event'], 404);
        }

        return response()->json($projects);
    } catch (\Exception $e) {
        Log::error('Error fetching projects: ' . $e->getMessage());
        return response()->json(['error' => 'Error fetching projects'], 500);
    }
}


            
        
       
            
public function save(Request $request)
{
    // Validate the form input
    $request->validate([
        'email' => 'required|string|email|max:255|unique:incharges', // Ensure 'incharges' table is used
        'password' => [
            'required',
            'string',
            'min:8', // Minimum length of 8 characters
            'regex:/[a-z]/', // At least one lowercase letter
            'regex:/[A-Z]/', // At least one uppercase letter
            'regex:/^\S*$/', // No spaces
            'confirmed', // Ensure password confirmation
        ],
    ], [
        'email.unique' => 'This email is already registered.',
        'password.min' => 'Password must be at least 8 characters long.',
        'password.regex' => 'Password must include at least one uppercase letter and one lowercase letter.',
        'password.confirmed' => 'Password confirmation does not match.',
    ]);
    
    // Create a new Incharge record
    $incharge = Incharge::create([
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hash the password
    ]);
    
    // Redirect to the incharge login page with a success message
    return redirect()->route('incharge.login')->with('message', 'Incharge account created successfully!');
}

            
         
        
     
           
            
            
            
            
            
        }
      
 