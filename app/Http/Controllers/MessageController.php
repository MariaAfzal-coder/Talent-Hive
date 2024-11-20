<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyStudentChat;
use App\Models\Student;
use App\Events\CompanyMessageSent;
class MessageController extends Controller
{

    public function sendstudentfirstMessage(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'receiver_id' => 'required|exists:companies,id', // Ensure receiver_id refers to companies
        'message' => 'required|string|max:255',
    ]);

    // Retrieve the logged-in student's ID from the session
    $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));

    // Check if the student is logged in
    if (!$LoggedStudentInfo) {
        return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
    }

    // Create a new chat message
    CompanyStudentChat::create([
        'sender_id' => $LoggedStudentInfo->id, // Use the logged-in student's ID
        'receiver_id' => $request->receiver_id, // This should be the company ID
        'message' => $request->message,
    ]);

    // Redirect back with a success message and a link
    return redirect()->back()->with('success', 'Message sent successfully! Click <a href="' . route('student.chats') . '">here</a> to go to chats.');
}


     public function sendfirstMessage(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'receiver_id' => 'required|exists:students,id',
            'message' => 'required|string|max:255',
        ]);
    
        // Get the logged-in company
        $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));
    
        if (!$LoggedCompanyInfo) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        // Create a new chat message
        CompanyStudentChat::create([
            'sender_id' => $LoggedCompanyInfo->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
    
        // Redirect back with a success message and a link
        return redirect()->back()->with('success', 'Message sent successfully! Click <a href="' . route('company.chats') . '">here</a> to go to chats.');
    }
    

    // app/Http/Controllers/CompanyController.php

public function fetchMessages($studentId)
{
    $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

    if (!$LoggedCompanyInfo) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Fetch messages between the logged-in company and the selected student
    $messages = CompanyStudentChat::where(function($query) use ($LoggedCompanyInfo, $studentId) {
        $query->where('sender_id', $LoggedCompanyInfo->id)
              ->where('receiver_id', $studentId);
    })->orWhere(function($query) use ($LoggedCompanyInfo, $studentId) {
        $query->where('sender_id', $studentId)
              ->where('receiver_id', $LoggedCompanyInfo->id);
    })->orderBy('created_at', 'asc')->get();

    return response()->json($messages);
}
public function sendCompanyMessage(Request $request)
{
    try {
        // Validate the incoming request
        $request->validate([
            'receiver_id' => 'required|exists:students,id',
            'message' => 'required|string|max:255',
        ]);

        // Get the logged-in company
        $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));

        if (!$LoggedCompanyInfo) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Create a new chat message
        $chatMessage = CompanyStudentChat::create([
            'sender_id' => $LoggedCompanyInfo->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
         broadcast(new  CompanyMessageSent($LoggedCompanyInfo->id, $request->receiver_id, $chatMessage->message));
        // Return the message data as JSON
        return response()->json([
            'message' => $chatMessage->message,
            'created_at' => $chatMessage->created_at
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


}
