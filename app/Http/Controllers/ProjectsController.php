<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

use App\Models\Student;
class ProjectsController extends Controller
{
    public function store(Request $request)
    {
        // Check if the student is logged in
        $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));
    
        if (!$LoggedStudentInfo) {
            return redirect()->route('student.login')->with('error', 'You must be logged in to access the dashboard.');
        }
    
        // Include the logged-in student as a member
        $members = $request->members;
        $members[] = $LoggedStudentInfo->id; // Add the logged-in student ID
    
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ending_date' => 'required|date|after:today', // Accept only future dates
            'abstract' => 'required|string',
            'languages' => 'required|array|min:1', // Ensure at least one language is added
            'supervised_by' => 'required|exists:supervisors,id', // Ensure supervised_by is a valid supervisor ID
            'video_file' => 'nullable|mimes:mp4,avi,mkv,webm|max:20480', // Max size: 20MB, adjust as needed
        ]);
    
        // Ensure exactly 2 members (including the logged-in student)
        if (count($members) !== 3) {
            return redirect()->back()->with('error', 'A project must have exactly 2 members, including the logged-in student.');
        }
    
        // Get the SDP of the first member as a reference
        $firstMemberId = $members[0];
        $firstMember = Student::find($firstMemberId);
        $referenceSdp = $firstMember ? trim($firstMember->sdp) : null;
    
        foreach ($members as $memberId) {
            $member = Student::find($memberId);
    
            // If a member is missing an SDP, return an error
            if (!$member || empty(trim($member->sdp))) {
                return redirect()->back()->with('error', 'All members must have an SDP.');
            }
    
            // If the member's SDP does not match the reference SDP
            if (trim($member->sdp) !== $referenceSdp) {
                return redirect()->back()->with('error', 'All members must have the same SDP.');
            }
        }
        // Create the project instance
        $project = new Project();
        $project->title = $request->title;
        $project->status = $request->status;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $project->image = $request->file('image')->store('project_images', 'public');
        }
    
        $project->ending_date = $request->ending_date;
        $project->abstract = $request->abstract;
        $project->languages = json_encode($request->languages); // Store languages as JSON
        $project->supervised_by = $request->supervised_by; // Store the supervisor's ID
    
        // Handle video file upload
        if ($request->hasFile('video_file')) {
            $project->video_url = $request->file('video_file')->store('project_videos', 'public');
        }
    
        // Save the project to get the project_id
        $project->save();
    
        // Check for duplicate members
        $existingMembers = DB::table('project_members')
            ->whereIn('student_id', $members)
            ->pluck('student_id')
            ->toArray();
    
        if (!empty($existingMembers)) {
            // Get names of students that are already assigned to other projects
            $students = Student::whereIn('id', $existingMembers)->get();
            $names = $students->pluck('name')->implode(', ');
    
            return redirect()->back()->with('error', 'The following students are already added to other projects: ' . $names);
        }
    
        // Insert project members into the project_members table
        foreach ($members as $studentId) {
            DB::table('project_members')->insert([
                'student_id' => $studentId,
                'project_id' => $project->id, // Use the saved project ID
            ]);
        }
    
        return redirect()->back()->with('message', 'Project created successfully.');
    }
    
    
    
    
    
    
}
