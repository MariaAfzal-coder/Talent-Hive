<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

use App\Models\Supervisor;
 use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB;
class SupervisorController extends Controller
{
    
        
         
    function login()
    {
        return view('supervisor.login');
    }
    

    function register()
    {
        return view('supervisor.register');
    }

    public function check(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
    
        $supervisorInfo = Supervisor::where('email', $request->email)->first();

        // Check if the supervisor exists
        if (!$supervisorInfo) {
            return back()->withInput()->withErrors(['email' => 'Email not found']);
        }
    
        // Check the password
        if (!Hash::check($request->password, $supervisorInfo->password)) {
            return back()->withInput()->withErrors(['password' => 'Incorrect password']);
        }
    
        // Set session for the logged-in supervisor
        session(['LoggedSupervisorInfo' => $supervisorInfo->id]);
    
        // Redirect to the supervisor dashboard
        return redirect()->route('supervisor.dashboard')->with('message', 'Login successful!');
    }
 
    



    public function logout()
    {
        // Check if the student is logged in
        if (session()->has('LoggedSupervisorInfo')) {
            // Forget the logged-in student session
            session()->forget('LoggedSupervisorInfo');
        }
    
        // Redirect to the student login page with a success message
        return redirect()->route('supervisor.login')->with('message', 'You have been logged out successfully.');
    }
    
    
    public function makeprofile()
    {
        $LoggedSupervisorInfo = Supervisor::find(session('LoggedSupervisorInfo'));
    
        // Check if the supervisor is logged in
        if (!$LoggedSupervisorInfo) {
            return redirect()->route('supervisor.login')->with('error', 'You must be logged in to access the profile.');
        }  
         // Decode JSON fields and ensure they are arrays
        $LoggedSupervisorInfo->education = json_decode($LoggedSupervisorInfo->education, true) ?: [];
        $LoggedSupervisorInfo->experience = json_decode($LoggedSupervisorInfo->experience, true) ?: [];
        $LoggedSupervisorInfo->awards_courses = json_decode($LoggedSupervisorInfo->awards_courses, true) ?: [];
    
        // Return the profile view with the supervisor's data
        return view('supervisor.makeprofile', [
            'LoggedSupervisorInfo' => $LoggedSupervisorInfo,
        ]);
    }

    public function showProject($id)
{
    // Retrieve the project by ID
    $project = Project::find($id);

    // Check if the project exists
    if (!$project) {
        return redirect()->route('supervisor.project')->with('error', 'Project not found.');
    }
    $LoggedSupervisorInfo = Supervisor::find(session('LoggedSupervisorInfo'));
    
    
    if (!$LoggedSupervisorInfo) {
    return redirect()->route('supervisor.login')->with('error', 'You must be logged in to access the dashboard.');
     }
    // Pass the project data to the view
    return view('supervisor.project_detail', compact('project','LoggedSupervisorInfo'));
}

    public function dashboard()
    {
   
    $LoggedSupervisorInfo = Supervisor::find(session('LoggedSupervisorInfo'));
    
    
   if (!$LoggedSupervisorInfo) {
   return redirect()->route('supervisor.login')->with('error', 'You must be logged in to access the dashboard.');
    }
    
   return view('supervisor.dashboard', [
  'LoggedSupervisorInfo' => $LoggedSupervisorInfo,
 ]);
    }
    
    public function profile()
    {
        // Retrieve the supervisor ID from session
        $supervisorId = session('LoggedSupervisorInfo');
    
        // Check if the session has the supervisor ID
        if (!$supervisorId) {
            return redirect()->route('supervisor.login')->with('error', 'You must be logged in to access the profile.');
        }
    
        // Find the supervisor by ID
        $LoggedSupervisorInfo = Supervisor::find($supervisorId);
    
        // Check if the supervisor exists
        if (!$LoggedSupervisorInfo) {
            return redirect()->route('supervisor.login')->with('error', 'Supervisor not found.');
        }
    
        // Decode JSON fields and ensure they are arrays
        $LoggedSupervisorInfo->education = json_decode($LoggedSupervisorInfo->education, true) ?: [];
        $LoggedSupervisorInfo->experience = json_decode($LoggedSupervisorInfo->experience, true) ?: [];
        $LoggedSupervisorInfo->awards_courses = json_decode($LoggedSupervisorInfo->awards_courses, true) ?: [];
    
        // Debugging: check the decoded data
        // Uncomment the following lines to debug
      // dd($LoggedSupervisorInfo->education, $LoggedSupervisorInfo->experience, $LoggedSupervisorInfo->awards_courses);
    
        // Return the profile view with the supervisor's data
        return view('supervisor.profile', [
            'LoggedSupervisorInfo' => $LoggedSupervisorInfo,
        ]);
    }


    public function updateProgress(Request $request, $id)
    {
        $request->validate([
            'progress' => 'required|integer|min:0|max:100',
        ]);
    
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['success' => false, 'message' => 'Project not found.'], 404);
        }
    
        // Update the progress
        $project->progress = $request->progress;
    
        // Check progress to update status
        if ($project->progress >= 100) {
            $project->status = 'Completed'; // Set status to Completed if progress is 100%
        } else {
            // Set status to In Progress if progress is less than 100
            $project->status = 'In Progress';
        }
    
        $project->save();
    
        return response()->json(['success' => true]);
    }
    

    public function statustracking()
    {
        // Retrieve the supervisor ID from session
        $supervisorId = session('LoggedSupervisorInfo');
    
        // Check if the session has the supervisor ID
        if (!$supervisorId) {
            return redirect()->route('supervisor.login')->with('error', 'You must be logged in to access the profile.');
        }
    
        // Find the supervisor by ID
        $LoggedSupervisorInfo = Supervisor::find($supervisorId);
    
        // Check if the supervisor exists
        if (!$LoggedSupervisorInfo) {
            return redirect()->route('supervisor.login')->with('error', 'Supervisor not found.');
        }
    
        // Decode JSON fields and ensure they are arrays
        $LoggedSupervisorInfo->education = json_decode($LoggedSupervisorInfo->education, true) ?: [];
        $LoggedSupervisorInfo->experience = json_decode($LoggedSupervisorInfo->experience, true) ?: [];
        $LoggedSupervisorInfo->awards_courses = json_decode($LoggedSupervisorInfo->awards_courses, true) ?: [];
    
        // Retrieve projects supervised by the logged-in supervisor
        $projects = Project::where('supervised_by', $supervisorId)->with('students')->paginate(3); // 10 projects per page
    
        // Return the profile view with the supervisor's data and projects
        return view('supervisor.statustracking', [
            'LoggedSupervisorInfo' => $LoggedSupervisorInfo,
            'projects' => $projects,
        ]);
    }
    
    public function project()
    {
        // Retrieve the supervisor ID from session
        $supervisorId = session('LoggedSupervisorInfo');
    
        // Check if the session has the supervisor ID
        if (!$supervisorId) {
            return redirect()->route('supervisor.login')->with('error', 'You must be logged in to access the profile.');
        }
    
        // Find the supervisor by ID
        $LoggedSupervisorInfo = Supervisor::find($supervisorId);
        
        // Retrieve projects supervised by the logged-in supervisor
        $projects = Project::where('supervised_by', $supervisorId)->with('students')->get();
    
        return view('supervisor.project', [
            'LoggedSupervisorInfo' => $LoggedSupervisorInfo,
            'projects' => $projects,
        ]);
    }
    
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'education' => 'array',
            'education.*.degree' => 'nullable|string|max:255',
            'education.*.year' => 'nullable|string|max:4',
            'education.*.university' => 'nullable|string|max:255',
            'experience' => 'array',
            'experience.*.post_hold' => 'nullable|string|max:255',
            'experience.*.from_year' => 'nullable|string|max:4',
            'experience.*.to_year' => 'nullable|string|max:4',
            'awards_courses' => 'array',
            'awards_courses.*.title' => 'nullable|string|max:255',
            'awards_courses.*.year' => 'nullable|string|max:4',
            'awards_courses.*.organization' => 'nullable|string|max:255',
            'additional_details' => 'nullable|string', // Add validation for additional_details
        ]);
    
        // Get the currently logged-in supervisor
        $supervisor = Supervisor::find(session('LoggedSupervisorInfo'));
    
        // Update supervisor's information using mass assignment
        $supervisor->fill($request->all());
    
        // Handle profile image update
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $supervisor->profile_image = $imagePath;
        }
    
        // Save all changes to the supervisor
        $supervisor->save();
    
        return redirect()->route('supervisor.profile')->with('success', 'Profile updated successfully!');
    }
    
    
    public function editprofile()
    {
        $LoggedSupervisorInfo = Supervisor::find(session('LoggedSupervisorInfo'));
    
        // Check if the supervisor is logged in
        if (!$LoggedSupervisorInfo) {
            return redirect()->route('supervisor.login')->with('error', 'You must be logged in to access the profile.');
        }
    
        // Decode JSON fields and ensure they are arrays
        $LoggedSupervisorInfo->education = json_decode($LoggedSupervisorInfo->education, true) ?: [];
        $LoggedSupervisorInfo->experience = json_decode($LoggedSupervisorInfo->experience, true) ?: [];
        $LoggedSupervisorInfo->awards_courses = json_decode($LoggedSupervisorInfo->awards_courses, true) ?: [];
    
        // Return the profile view with the supervisor's data
        return view('supervisor.editprofile', [
            'LoggedSupervisorInfo' => $LoggedSupervisorInfo,
        ]);
    }
    
    public function save(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:supervisors', // Ensure 'supervisors' table is used
        'password' => [
            'required',
            'string',
            'min:8',
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
    
    $supervisor = Supervisor::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    
    return redirect()->route('supervisor.login')->with('message', 'Supervisor account created successfully!');
}


    
}