<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Make sure to install and configure a PDF library, e.g., dompdf or barryvdh/laravel-dompdf.
    use App\Models\Student;
class CertificateController extends Controller
{
    
    public function generate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string',
            'sapid' => 'required|string',
            'sdp' => 'required|string',
        ]);
    
        // Find the student by SAP ID
        $student = Student::where('sapid', $request->sapid)->first();
    
        // If the student exists, update their certification status
        if ($student) {
            // Set certification status and image path based on SDP
            $certificateImage = $request->sdp === 'Part-1' 
                ? asset('assets/images/sdp1.png') 
                : asset('assets/images/sdp2.png');  // Adjust path as needed
    
            // Update the student's certification details
            $student->update([
                'certification_status' => 'awarded',
                'certification_image' => $certificateImage,  // Store image path in database if needed
            ]);
        }
    
        // Prepare the data for displaying the certificate
        $data = [
            'name' => $request->name,
            'sapid' => $request->sapid,
            'sdp' => $request->sdp,
            'certificateImage' => $certificateImage, // Pass the image path to the view
        ];
    
        // Return the certificate view
        return view('incharge.certificate', $data);
    }
    
    public function downloadCertificate(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string',
            'sapid' => 'required|string',
            'sdp' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'sapid' => $request->sapid,
            'sdp' => $request->sdp,
        ];

        // Load a view to create the PDF
        $pdf = PDF::loadView('incharge.certificate', $data);

        // Return the generated PDF as a response
        return $pdf->download($data['name'] . '_Certificate.pdf');
    }
    }
 