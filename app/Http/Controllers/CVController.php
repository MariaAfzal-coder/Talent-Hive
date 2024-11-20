<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CV;
use Illuminate\Support\Facades\Storage;
 use App\Models\Student;
  use PDF; // Make sure the alias is set in config/app.php

class CVController extends Controller
{


    public function downloadCV($id)
    {
        // Retrieve the student based on the provided ID
        $LoggedStudentInfo = Student::find($id);

        // Redirect if the student is not found
        if (!$LoggedStudentInfo) {
            return redirect()->route('student.login')->with('error', 'Student not found.');
        }

        // Retrieve the CV associated with the student
        $cv = CV::where('student_id', $LoggedStudentInfo->id)->first();

        // Ensure the CV exists
        if (!$cv) {
            return redirect()->back()->with('error', 'No CV found for the specified student.');
        }

        // Generate the PDF using the PDF facade
        $pdf = PDF::loadView('student.cv_pdf', compact('cv', 'LoggedStudentInfo'));

        // Return the generated PDF as a download
        return $pdf->download($LoggedStudentInfo->name . '_cv.pdf');
    }
    public function exportCV()
    {
        // Retrieve the logged-in student's info
        $LoggedStudentInfo = Student::find(session('LoggedStudentInfo'));

        // Redirect if the student is not logged in
        if (!$LoggedStudentInfo) {
            return redirect()->route('student.login')->with('error', 'You must be logged in to export your CV.');
        }

        // Retrieve the CV for the logged-in student
        $cv = CV::where('student_id', $LoggedStudentInfo->id)->firstOrFail();

        // Generate the PDF using the PDF facade
        $pdf = PDF::loadView('student.cv_pdf', compact('cv', 'LoggedStudentInfo'));

        // Return the generated PDF as a download
        return $pdf->download($LoggedStudentInfo->name . '_cv.pdf');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'profile' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'additional-info' => 'nullable|string',
            'education' => 'required|string',
            'skillsUsed' => 'nullable|array',
            'languageUsed' => 'nullable|array',
            'work-experience' => 'required|string',
        ]);
    
        // Handle the uploaded image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cv_images', 'public');
        }
    
        // Check if the student already has a CV entry in the database
        $cv = CV::where('student_id', session('LoggedStudentInfo'))->first();
    
        if ($cv) {
            // If CV exists, update it
            $cv->update([
                'image' => $imagePath ? $imagePath : $cv->image, // Only update image if a new one is uploaded
                'name' => $request->name,
                'profile' => $request->profile,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'additional_info' => $request->input('additional-info'),
                'education' => $request->education,
                'skills' => json_encode($request->input('skillsUsed')), // Convert skills array to JSON
                'languages' => json_encode($request->input('languageUsed')), // Convert languages array to JSON
                'work_experience' => $request->input('work-experience'),
            ]);
        } else {
            // If CV doesn't exist, create a new one
            CV::create([
                'student_id' => session('LoggedStudentInfo'), // Assuming you have the student ID in session
                'image' => $imagePath,
                'name' => $request->name,
                'profile' => $request->profile,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'additional_info' => $request->input('additional-info'),
                'education' => $request->education,
                'skills' => json_encode($request->input('skillsUsed')), // Convert skills array to JSON
                'languages' => json_encode($request->input('languageUsed')), // Convert languages array to JSON
                'work_experience' => $request->input('work-experience'),
            ]);
        }
    
        return redirect()->back()->with('success', 'CV submitted successfully!');
    }
    
}
