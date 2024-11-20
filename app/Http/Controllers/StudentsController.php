<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CompanyStudentChat;

 use App\Http\Controllers\Controller;
use App\Models\Student; 
use App\Models\InterviewSchedule; 
use App\Models\Company; 

use App\Models\Users\User;
use App\Models\Part; // Add this at the top
use App\Models\Fault; // Add this at the top
use App\Models\CV; // Add this at the top
use App\Models\Supervisor; 
use App\Events\StudentMessageSent;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB;
class StudentsController extends Controller
{
     

   
      
    
     
    
        
        
        
        
         
     
    
     
        
        
         
        function login()
        {
            return view('student.login');
        }
        
    
        function register()
        {
            return view('student.register');
        }
    
    
    
    
    
    
        public function check(Request $request)
        {
            // Validate the input
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:5|max:12'
            ]);
        
            // Attempt to find the student by email
            $studentInfo = Student::where('email', $request->email)->first();
        
            // Check if the student exists
            if (!$studentInfo) {
                return back()->withInput()->withErrors(['email' => 'Email not found']);
            }
        
            // Check account status
            
            // Check the password
            if (!Hash::check($request->password, $studentInfo->password)) {
                return back()->withInput()->withErrors(['password' => 'Incorrect password']);
            }
        
            // Set session for the logged-in student
            session(['LoggedStudentInfo' => $studentInfo->id]);
        
            // Redirect to the student dashboard or a desired route
            return redirect()->route('student.dashboard')->with('message', 'Login successful!'); // Optional success message
        }
        
    
    
    
        public function logout()
        {
            // Check if the student is logged in
            if (session()->has('LoggedStudentInfo')) {
                // Forget the logged-in student session
                session()->forget('LoggedStudentInfo');
            }
        
            // Redirect to the student login page with a success message
            return redirect()->route('student.login')->with('message', 'You have been logged out successfully.');
        }
        
        
        public function createproject()
        {
            // Retrieve the logged-in student's ID from the session
            $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
        
            // Check if the student is logged in
            if (!$LoggedStudentInfo) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
            }
            $receivedMessages = CompanyStudentChat::where('receiver_id', $LoggedStudentInfo)
            ->with(['studentSender', 'companySender']) // Eager load companySender
            ->orderBy('created_at', 'desc')
            ->get();
            // Retrieve all students to display in the dropdown
            $students = Student::all(); // Fetch all students
            $supervisors = Supervisor::all(); // Fetch all supervisors
    // Fetch all notifications for the logged-in student
    $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
        
    // Count total notifications
    $notificationCount = $notifications->count();

            // Pass the logged-in student info and students data to the view
            return view('student.createproject', [
                'receivedMessages'=>$receivedMessages,
                'LoggedStudentInfo' => $LoggedStudentInfo,
                'notifications' => $notifications,
                'notificationCount' => $notificationCount,
                'students' => $students,  // Pass students data to the view
                'supervisors' => $supervisors,  // Pass supervisors data to the view

            ]);
        }
        public function chats()
        {
            // Retrieve the logged-in student's ID from the session
            $loggedStudentId = session('LoggedStudentInfo');
        
            // Check if the student ID is present in the session
            if (!$loggedStudentId) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
            }
        
            // Retrieve the logged-in student's details
            $LoggedStudentInfo = Student::find($loggedStudentId);
        
            // Check if the student is logged in
            if (!$LoggedStudentInfo) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
            }
        
            // Get chats where the logged-in student is either the sender or receiver
            $chats = CompanyStudentChat::where(function($query) use ($loggedStudentId) {
                    $query->where('sender_id', $loggedStudentId)
                          ->orWhere('receiver_id', $loggedStudentId);
                })
                ->with(['companyReceiver', 'companySender', 'studentSender']) // Eager load relationships
                ->get();
        
            // Group chats by company and keep the most recent message
            $groupedChats = $chats->groupBy(function ($chat) use ($loggedStudentId) {
                // If the student is the sender, group by the company receiver
                if ($chat->sender_id === $loggedStudentId) {
                    return optional($chat->companyReceiver)->id;
                }
                // If the student is the receiver, group by the company sender
                else {
                    return optional($chat->companySender)->id;
                }
            })->map(function ($chatGroup) {
                return $chatGroup->sortByDesc('created_at')->first(); // Get the most recent chat in each group
            });
        
            // Fetch all notifications for the logged-in student
            $notifications = InterviewSchedule::where('student_id', $loggedStudentId)->get();
        
            // Count total notifications
            $notificationCount = $notifications->count();
        
            // Pass data to the chat view
            return view('student.chats', [
                'LoggedStudentInfo' => $LoggedStudentInfo,
                'loggedStudentId' => $loggedStudentId,
                'groupedChats' => $groupedChats,
                'notifications' => $notifications,
                'notificationCount' => $notificationCount,
            ]);
        }
        
         
public function sendMessage(Request $request)
{
    try {
        // Validate the incoming request
        $request->validate([
            'receiver_id' => 'required|exists:companies,id', // Ensure the receiver exists
            'message' => 'required|string|max:500', // Adjust max length as needed
        ]);

        // Get the logged-in student's ID from the session
        $loggedStudentId = session('LoggedStudentInfo');

        // Create the chat message
        $chatMessage = CompanyStudentChat::create([
            'sender_id' => $loggedStudentId,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Broadcast the message to others, excluding the sender
        broadcast(new  StudentMessageSent(
            $chatMessage->message,
            $chatMessage->receiver_id,
            $chatMessage->sender_id
        ))->toOthers();

        // Return a JSON response
        return response()->json([
            'message' => $chatMessage->message,
            'created_at' => $chatMessage->created_at->toDateTimeString(), // Return formatted timestamp
            'success' => 'Message sent successfully.'
        ]);
    } catch (\Exception $e) {
        // Return an error response if something goes wrong
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function fetchMessages($companyId)
{
    // Retrieve the logged-in student's ID from the session
    $loggedStudentId = session('LoggedStudentInfo');

    // Check if the student is logged in
    if (!$loggedStudentId) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Fetch messages where the logged-in student is either the sender or receiver, and the selected company is the other participant
    $messages = CompanyStudentChat::where(function ($query) use ($loggedStudentId, $companyId) {
        $query->where('sender_id', $loggedStudentId)
              ->where('receiver_id', $companyId);
    })->orWhere(function ($query) use ($loggedStudentId, $companyId) {
        $query->where('sender_id', $companyId)
              ->where('receiver_id', $loggedStudentId);
    })->orderBy('created_at', 'asc') // Order messages by creation time
    ->get();

    // Return the messages as JSON
    return response()->json($messages);
}
       
        public function dashboard()
        {
            $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));

            // Check if the student is logged in
            if (!$LoggedStudentInfo) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
            }
        
            // Fetch all notifications for the logged-in student
            $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
          // Retrieve the logged-in student's ID from the session
            $receivedMessages = CompanyStudentChat::where('receiver_id', $LoggedStudentInfo)
            ->with(['studentSender', 'companySender']) // Eager load companySender
            ->orderBy('created_at', 'desc')
            ->get();
            // Count total notifications
            $notificationCount = $notifications->count();
        
            // Pass the logged-in student info and notifications to the dashboard view
            return view('student.dashboard', [
                'LoggedStudentInfo' => $LoggedStudentInfo,
                'notifications' => $notifications,
                'notificationCount' => $notificationCount,
                'receivedMessages' => $receivedMessages,

            ]);
        }
        public function getCompanyName($id)
    {
        // Fetch the company using the provided sender_id
        $company = Company::find($id);

        // Check if the company exists
        if ($company) {
            return response()->json([
                'name' => $company->name
            ]);
        } else {
            return response()->json([
                'error' => 'Company not found'
            ], 404);
        }
    }
        public function interview()
        {
            // Retrieve the logged-in student's ID from the session
            $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
        
            // Check if the student is logged in
            if (!$LoggedStudentInfo) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
            }
         // Fetch all notifications for the logged-in student
         $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
        
         // Count total notifications
         $notificationCount = $notifications->count();
            // Retrieve the CV associated with the logged-in student
            $cv = CV::where('student_id', $LoggedStudentInfo->id)->first(); // Adjust if necessary to match your field name
            $receivedMessages = CompanyStudentChat::where('receiver_id', $LoggedStudentInfo)
            ->with(['studentSender', 'companySender']) // Eager load companySender
            ->orderBy('created_at', 'desc')
            ->get();
            // Pass the logged-in student info and CV to the dashboard view
            return view('student.interview', [
                'LoggedStudentInfo' => $LoggedStudentInfo,
                'receivedMessages'=>$receivedMessages,
                'notifications' => $notifications,
                'notificationCount' => $notificationCount,
                'cv' => $cv,
            ]);
        }
        
        public function cv()
        {
            // Retrieve the logged-in student's ID from the session
            $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
        
            // Check if the student is logged in
            if (!$LoggedStudentInfo) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
            }
         // Fetch all notifications for the logged-in student
         $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
        
         // Count total notifications
         $notificationCount = $notifications->count();
            // Retrieve the CV associated with the logged-in student
            $cv = CV::where('student_id', $LoggedStudentInfo->id)->first(); // Adjust if necessary to match your field name
            $receivedMessages = CompanyStudentChat::where('receiver_id', $LoggedStudentInfo)
            ->with(['studentSender', 'companySender']) // Eager load companySender
            ->orderBy('created_at', 'desc')
            ->get();
            // Pass the logged-in student info and CV to the dashboard view
            return view('student.cv', [
                'LoggedStudentInfo' => $LoggedStudentInfo,
                'receivedMessages'=>$receivedMessages,
                'notifications' => $notifications,
                'notificationCount' => $notificationCount,
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
          // Fetch all notifications for the logged-in student
          $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
        
          // Count total notifications
          $notificationCount = $notifications->count();
         
            // Retrieve the projects associated with the logged-in student via Eloquent relationship
            $projects = $LoggedStudentInfo->projects; // Automatically uses the relationship defined
            $receivedMessages = CompanyStudentChat::where('receiver_id', $LoggedStudentInfo)
            ->with(['studentSender', 'companySender']) // Eager load companySender
            ->orderBy('created_at', 'desc')
            ->get();
         
            // Pass the logged-in student info and projects to the dashboard view
            return view('student.projectdetails', [
                'notifications' => $notifications,
                'receivedMessages'=>$receivedMessages,
                'notificationCount' => $notificationCount,
         
                'LoggedStudentInfo' => $LoggedStudentInfo,
                'projects' => $projects, // Pass the projects data
            ]);
        }
        
        
        public function save(Request $request)
        {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:students', // Ensure 'students' table is used
                'sapid' => 'required|string|max:50|unique:students', // Fix the field name to sap_id
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
                'sapid.unique' => 'This SapID is already registered.',
                'password.min' => 'Password must be at least 8 characters long.',
                'password.regex' => 'Password must include at least one uppercase letter and one lowercase letter.',
                'password.confirmed' => 'Password confirmation does not match.',
            ]);
            
            $student = Student::create([
                'email' => $request->email,
                'sapid' => $request->sapid, // Save the SapID
                'password' => Hash::make($request->password),
            ]);
            
            return redirect()->route('student.login')->with('message', 'Student account created successfully!');
        }
        
    
        public function updateProfile(Request $request)
        {
            // Validate the request
            $request->validate([
                'name' => 'nullable|string|max:255',
                'phone' => 'nullable|max:13',
                'cgpa' => 'nullable|numeric|min:0|max:4',
                'sdp' => 'nullable|string',
                'department' => 'nullable|string',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'sapid' => 'nullable|string', // Added sapid validation
            ]);
        
            // Find the logged-in student
            $student = Student::find(session('LoggedStudentInfo'));
        
            if (!$student) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to update your profile.');
            }
        
            // Update student details if provided, otherwise retain current values
            $student->name = $request->input('name', $student->name); // Update if provided, otherwise retain current value
            $student->phone = $request->input('phone', $student->phone); 
            $student->cgpa = $request->input('cgpa', $student->cgpa); 
            $student->sdp = $request->input('sdp', $student->sdp); 
            $student->department = $request->input('department', $student->department);
            $student->sapid = $request->input('sapid', $student->sapid); // Ensure sapid is updated if provided
        
            // Handle profile image upload if provided
            if ($request->hasFile('profile_image')) {
                // Delete old profile image if it exists
                if ($student->profile_image) {
                    Storage::delete('public/' . $student->profile_image);
                }
        
                // Store the new image and update the profile image path
                $imagePath = $request->file('profile_image')->store('public/downloads');
                $student->profile_image = str_replace('public/', '', $imagePath);
            }
        
            // Save the updated student data
            $student->save();
        
            // Redirect back to the profile page with a success message
            return redirect()->route('student.viewprofile')->with('message', 'Profile updated successfully.');
        }
        
        
        
        public function profile()
        {
            
           // Retrieve the logged-in student's ID from the session
           $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
           $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
        
          // Count total notifications
          $notificationCount = $notifications->count();
         
       
           // Check if the student is logged in
           if (!$LoggedStudentInfo) {
               return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
           }
        // Retrieve the logged-in student's ID from the session
        $receivedMessages = CompanyStudentChat::where('receiver_id', $LoggedStudentInfo)
        ->with(['studentSender', 'companySender']) // Eager load companySender
        ->orderBy('created_at', 'desc')
        ->get();
           // Pass the logged-in student info to the dashboard view
           return view('student.profile', [
            'notifications' => $notifications,
            'receivedMessages'=>$receivedMessages,
            'notificationCount' => $notificationCount,
     
            'LoggedStudentInfo' => $LoggedStudentInfo,
           ]);
         }
         public function certificate()
         {
             
            // Retrieve the logged-in student's ID from the session
            $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
            $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
         
           // Count total notifications
           $notificationCount = $notifications->count();
          
        
            // Check if the student is logged in
            if (!$LoggedStudentInfo) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
            }
         // Retrieve the logged-in student's ID from the session
         $receivedMessages = CompanyStudentChat::where('receiver_id', $LoggedStudentInfo)
         ->with(['studentSender', 'companySender']) // Eager load companySender
         ->orderBy('created_at', 'desc')
         ->get();
            // Pass the logged-in student info to the dashboard view
            return view('student.certificate', [
             'notifications' => $notifications,
             'receivedMessages'=>$receivedMessages,
             'notificationCount' => $notificationCount,
      
             'LoggedStudentInfo' => $LoggedStudentInfo,
            ]);
          }
 
           
         
        public function editprofile()
        {
            
           // Retrieve the logged-in student's ID from the session
           $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
           $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
        
          // Count total notifications
          $notificationCount = $notifications->count();
          $receivedMessages = CompanyStudentChat::where('receiver_id', $LoggedStudentInfo)
          ->with(['studentSender', 'companySender']) // Eager load companySender
          ->orderBy('created_at', 'desc')
          ->get();
       
           // Check if the student is logged in
           if (!$LoggedStudentInfo) {
               return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
           }
       
           // Pass the logged-in student info to the dashboard view
           return view('student.editprofile', [
            'receivedMessages'=>$receivedMessages,
            'notifications' => $notifications,
            'notificationCount' => $notificationCount,
     
            'LoggedStudentInfo' => $LoggedStudentInfo,
           ]);
         }
      
         public function viewprofile()
         {
             
            // Retrieve the logged-in student's ID from the session
            $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
            $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
         
           // Count total notifications
           $notificationCount = $notifications->count();
           $receivedMessages = CompanyStudentChat::where('receiver_id', $LoggedStudentInfo)
           ->with(['studentSender', 'companySender']) // Eager load companySender
           ->orderBy('created_at', 'desc')
           ->get();
        
            // Check if the student is logged in
            if (!$LoggedStudentInfo) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
            }
        
            // Pass the logged-in student info to the dashboard view
            return view('student.viewprofile', [
             'receivedMessages'=>$receivedMessages,
             'notifications' => $notifications,
             'notificationCount' => $notificationCount,
      
             'LoggedStudentInfo' => $LoggedStudentInfo,
            ]);
          }
         

         public function makeprofile()
         {
             
             $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
            $notifications = InterviewSchedule::where('student_id', $LoggedStudentInfo->id)->get();
         
           // Count total notifications
           $notificationCount = $notifications->count();
          
        
            // Check if the student is logged in
            if (!$LoggedStudentInfo) {
                return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
            }
        
            // Pass the logged-in student info to the dashboard view
            return view('student.makeprofile', [
             'notifications' => $notifications,
             'notificationCount' => $notificationCount,
      
             'LoggedStudentInfo' => $LoggedStudentInfo,
            ]);
          }
  
        public function vehicle()
    {
        // Retrieve logged admin info
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));
        
        // Check if admin is logged in
        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
        }
        
        // Retrieve vehicles added by the logged-in admin
        $vehicles = Vehicle::where('admin_id', $LoggedAdminInfo->id)->paginate(5);
        $parts = Part::with('category')->get(); // Assuming you have a Part model
        $faults = Fault::all(); // Assuming you have a Fault model
    
        // Pass both vehicles and logged admin info to the view
        return view('admin.vehicle', compact('vehicles', 'LoggedAdminInfo' ,'parts','faults'));
    }
    
       
        
        
        
        
        
    }
  