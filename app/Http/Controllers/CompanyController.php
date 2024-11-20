<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash; 

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\CV;
use App\Models\InterviewSchedule;
use App\Models\CompanyStudentChat;
use App\Models\Comment;

class CompanyController extends Controller
{
       
         
    function login()
    {
        return view('company.login');
    }
    

    function register()
    {
        return view('company.register');
    }


    
   

    
    
    public function createproject()
    {
        // Retrieve the logged-in student's ID from the session
        $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
    
        // Check if the student is logged in
        if (!$LoggedStudentInfo) {
            return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
        }
    
        // Retrieve all students to display in the dropdown
        $students = Student::all(); // Fetch all students
        $supervisors = Supervisor::all(); // Fetch all supervisors

        // Pass the logged-in student info and students data to the view
        return view('student.createproject', [
            'LoggedStudentInfo' => $LoggedStudentInfo,
            'students' => $students,  // Pass students data to the view
            'supervisors' => $supervisors,  // Pass supervisors data to the view

        ]);
    }
    


     
    public function check(Request $request)
{
    // Validate the input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5|max:12'
    ]);

    // Attempt to find the company by email
    $companyInfo = Company::where('email', $request->email)->first();

    // Check if the company exists
    if (!$companyInfo) {
        return back()->withInput()->withErrors(['email' => 'Email not found']);
    }

    // Check the password
    if (!Hash::check($request->password, $companyInfo->password)) {
        return back()->withInput()->withErrors(['password' => 'Incorrect password']);
    }

    // Set session for the logged-in company
    session(['LoggedCompanyInfo' => $companyInfo->id]);

    // Redirect to the company dashboard or a desired route
    return redirect()->route('company.dashboard')->with('message', 'Login successful!'); // Optional success message
}

    

public function logout()
{
    // Check if the company is logged in
    if (session()->has('LoggedCompanyInfo')) {
        // Forget the logged-in company session
        session()->forget('LoggedCompanyInfo');
    }

    // Redirect to the company login page with a success message
    return redirect()->route('company.login')->with('message', 'You have been logged out successfully.');
}

public function dashboard()
{
    // Retrieve the logged-in company's ID from the session
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    // Pass the logged-in company info to the dashboard view
    return view('company.dashboard', [
        'LoggedCompanyInfo' => $LoggedCompanyInfo,
    ]);
}


public function hiring(Request $request)
{
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    // Fetch interviews scheduled by this company
    $interviews = InterviewSchedule::where('company_id', $LoggedCompanyInfo->id)
        ->with(['student', 'student.cv']) // Load student with cv
        ->get();
 
        

     
    return view('company.hiringcandidate', compact('LoggedCompanyInfo', 'interviews'));
}
public function pendingcandidate(Request $request)
{
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    // Fetch interviews with 'interview_inprocess' status scheduled by this company
    $interviews = InterviewSchedule::where('company_id', $LoggedCompanyInfo->id)
        ->where('status', 'interview_inprocess') // Filter by status
        ->with(['student', 'student.cv']) // Load student and their CV
        ->get();

    // Fetch two projects for the logged-in company (you can adjust the condition to filter based on student_id if needed)
    $projects = Project::take(2)->get();

    return view('company.pendingcandidate', compact('LoggedCompanyInfo', 'interviews', 'projects'));
}




public function showStudentCV($id)
{
    $student = Student::with('cv')->findOrFail($id); // Eager load the CV relationship
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    return view('company.student_cv', compact('student', 'LoggedCompanyInfo'));
}
public function analyzeCV($studentId)
{
    $student = Student::with('cv')->findOrFail($studentId);
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Get the student's skills and the company's technologies
    $studentSkills = json_decode($student->cv->skills, true);
    $companyTechnologies = json_decode($LoggedCompanyInfo->technologies, true);

    // Calculate matching skills
    $matchingSkills = array_intersect($studentSkills, $companyTechnologies);
    $matchingCount = count($matchingSkills);
    $totalSkills = count($companyTechnologies);

    // Calculate the score as a percentage
    $score = $totalSkills > 0 ? round(($matchingCount / $totalSkills) * 100) : 0; // Avoid division by zero

    
    return response()->json([
        'score' => $score,
        'matchingSkills' => $matchingSkills,
    ]);
}



public function storeComment(Request $request)
{
    $request->validate([
        'project_id' => 'required|integer',
        'company_id' => 'required|integer',
        'comment' => 'required|string|max:1000',
    ]);

    Comment::create([
        'project_id' => $request->project_id,
        'company_id' => $request->company_id,
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success', 'Comment added successfully.');
}


public function project()
{
    // Retrieve the logged-in company's ID from the session
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }
    $projects = Project::paginate(3);

    // Pass the logged-in company info to the dashboard view
    return view('company.project', [
        'LoggedCompanyInfo' => $LoggedCompanyInfo,
        'projects' => $projects,

    ]);
}

public function chats()
{
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    // Get chats where the logged-in company is either the sender or receiver
    $chats = CompanyStudentChat::where('sender_id', $LoggedCompanyInfo->id)
        ->orWhere('receiver_id', $LoggedCompanyInfo->id)
        ->with(['studentReceiver', 'studentSender']) // Eager load relationships
        ->get();

    // Group chats by the other participant
    $groupedChats = $chats->groupBy(function ($chat) use ($LoggedCompanyInfo) {
        return ($chat->sender_id === $LoggedCompanyInfo->id) 
            ? $chat->studentReceiver->id 
            : $chat->studentSender->id;
    });

    return view('company.chats', [
        'LoggedCompanyInfo' => $LoggedCompanyInfo,
        'groupedChats' => $groupedChats,
    ]);
}


public function profile()
{
    
  
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }
   // Pass the logged-in student info to the dashboard view
   return view('company.profile', [
       'LoggedCompanyInfo' => $LoggedCompanyInfo,
   ]);
 }
 public function updateProfile(Request $request)
{
    // Check if the company is logged in
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    // Define validation rules, allowing optional fields
    $validatedData = $request->validate([
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'phonenumber' => 'nullable|string|max:15',
        'nationaltaxnumber' => 'nullable|string|max:20',
        'location' => 'nullable|string|max:80000',
'technologies' => 'nullable|array',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Make sure to validate the profile image
    ]);

    // Update company details only if the fields are present in the request
    if (isset($validatedData['name'])) {
        $LoggedCompanyInfo->name = $validatedData['name'];
    }

    if (isset($validatedData['email'])) {
        $LoggedCompanyInfo->email = $validatedData['email'];
    }

    if (isset($validatedData['phonenumber'])) {
        $LoggedCompanyInfo->phonenumber = $validatedData['phonenumber'];
    }

    if (isset($validatedData['nationaltaxnumber'])) {
        $LoggedCompanyInfo->nationaltaxnumber = $validatedData['nationaltaxnumber'];
    }

    if (isset($validatedData['location'])) {
        $LoggedCompanyInfo->location = $validatedData['location'];
    }
    if ($request->has('technologies')) {
        $LoggedCompanyInfo->technologies = json_encode($request->input('technologies'));
    }
    
    // Handle the profile picture upload
    if ($request->hasFile('profile_image')) { // Ensure this matches the input name
        // Delete old profile image if it exists
        if ($LoggedCompanyInfo->profile_image) {
            Storage::delete($LoggedCompanyInfo->profile_image);
        }

        // Store the new image in 'public/downloads'
        $imagePath = $request->file('profile_image')->store('public/downloads');
        $LoggedCompanyInfo->profile_image = str_replace('public/', '', $imagePath); // Remove 'public/' from path
    }

    // Save the updated company information
    $LoggedCompanyInfo->save();

    return redirect()->route('company.profile')->with('success', 'Profile updated successfully.');
}

 
 
public function show($id)
{


    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }
    // Find the project by ID
    $project = Project::findOrFail($id);

    // Pass the project data to the view
    return view('company.detail', compact('project','LoggedCompanyInfo')); // Adjust view name as needed
}
public function editprofile()
{


    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }
    // Find the project by ID
   //$project = Project::findOrFail($id);

    // Pass the project data to the view
    return view('company.editprofile', compact('LoggedCompanyInfo')); // Adjust view name as needed
}

public function makeprofile()
{


    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    // Check if the company is logged in
    if (!$LoggedCompanyInfo) {
        return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
    }
    // Find the project by ID
   //$project = Project::findOrFail($id);

    // Pass the project data to the view
    return view('company.makeprofile', compact('LoggedCompanyInfo')); // Adjust view name as needed
}
    public function cv()
    {
        // Retrieve the logged-in student's ID from the session
        $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
    
        // Check if the student is logged in
        if (!$LoggedStudentInfo) {
            return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
        }
    
        // Retrieve the CV associated with the logged-in student
        $cv = CV::where('student_id', $LoggedStudentInfo->id)->first(); // Adjust if necessary to match your field name
    
        // Pass the logged-in student info and CV to the dashboard view
        return view('student.cv', [
            'LoggedStudentInfo' => $LoggedStudentInfo,
            'cv' => $cv,
        ]);
    }
    
    public function projectdetails()
    {
        // Retrieve the logged-in student's ID from the session
        $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
    
        // Check if the student is logged in
        if (!$LoggedStudentInfo) {
            return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
        }
    
        // Retrieve the projects associated with the logged-in student via Eloquent relationship
        $projects = $LoggedStudentInfo->projects; // Automatically uses the relationship defined
    
        // Pass the logged-in student info and projects to the dashboard view
        return view('student.projectdetails', [
            'LoggedStudentInfo' => $LoggedStudentInfo,
            'projects' => $projects, // Pass the projects data
        ]);
    }


    
    public function save(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255', // Validate company name
        'email' => 'required|string|email|max:255|unique:companies', // Ensure unique email in companies table
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
        'name.required' => 'Company name is required.',
        'password.min' => 'Password must be at least 8 characters long.',
        'password.regex' => 'Password must include at least one uppercase letter and one lowercase letter.',
        'password.confirmed' => 'Password confirmation does not match.',
    ]);

    // Create the company record
    Company::create([
        'name' => $request->name, // Save the company name
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('company.login')->with('message', 'Company account created successfully!');
}




    
   
}
