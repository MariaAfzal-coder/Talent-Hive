<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\InterviewSchedule;

use Illuminate\Http\Request;
use App\Events\SendScheduleInterview; // Import the event at the top

 class InterviewController extends Controller
{
    public function store(Request $request)
    {
        // Check if the company is logged in
        $LoggedCompanyInfo = Company::find(session('LoggedCompanyInfo'));
        if (!$LoggedCompanyInfo) {
            return redirect()->route('company.login')->with('error', 'You must be logged in to access the dashboard.');
        }
        
        $validated = $request->validate([
            'studentId' => 'required|integer|exists:students,id', // Ensure the student exists
            'date' => 'required|date|after_or_equal:today', // Ensure date is today or in the future
            'time' => 'required|date_format:H:i', // Validate time format (24-hour)
            'venue' => 'required|string',
        ], [
            'date.after_or_equal' => 'The date must be today or a future date.',
            'time.date_format' => 'The time must be in HH:mm format.',
        ]);
    
        // Combine date and time for complete validation
        $dateTime = \Carbon\Carbon::parse("{$validated['date']} {$validated['time']}");
        
        // Check if the scheduled date and time are in the past
        if ($dateTime->isPast()) {
            return redirect()->back()->withErrors(['error' => 'The date and time must be in the future.'])->withInput();
        }
    
        // Check if an interview is already scheduled with this student
        $existingInterview = InterviewSchedule::where('student_id', $validated['studentId'])
                                               ->where('company_id', $LoggedCompanyInfo->id)
                                               ->first();
    
        if ($existingInterview) {
            return redirect()->back()->with('error', 'Interview already scheduled with this student.');
        }
    
        // Store the interview details in the database
        $interviewSchedule = InterviewSchedule::create([
            'student_id' => $validated['studentId'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'venue' => $validated['venue'],
            'company_id' => $LoggedCompanyInfo->id,
        ]);
    
        // Broadcast the event to notify others
        broadcast(new SendScheduleInterview($interviewSchedule, $LoggedCompanyInfo))->toOthers();
    
        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Interview scheduled successfully.');
    }
    

public function updateStatus(Request $request)
{
    // Validate incoming request
    $request->validate([
        'id' => 'required|exists:interview_schedules,id',
        'status' => 'required|in:hired,not_hired,interview_inprocess',
    ]);

    // Update the interview status
    $interview = InterviewSchedule::find($request->id);
    $interview->status = $request->status;
    $interview->save();
    return redirect()->back()->with('success', 'Status updated successfully');

    // Redirect back with success message
 }

    
}
