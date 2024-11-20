<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
 
use App\Models\Incharge;
 
 
class EventController extends Controller
{
 
    public function update(Request $request, $id)
{
    // Retrieve the logged-in in-charge ID
    $LoggedInchargeInfo = Incharge::find(session('LoggedInchargeInfo'));
    if (!$LoggedInchargeInfo) {
        return redirect()->route('incharge.login')->with('error', 'You must be logged in to access this page.');
    }

    // Validate the request data
    $request->validate([
        'event_name' => 'required|string|max:255',
        'session' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'description' => 'required|string',
        'projects' => 'array', // Projects should be an array, adjust validation if needed
    ]);

    // Find the event by ID
    $event = Event::findOrFail($id);

    // Update event properties (excluding incharge_id)
    $event->event_name = $request->input('event_name');
    $event->session = $request->input('session');
    $event->start_date = $request->input('start_date');
    $event->end_date = $request->input('end_date');
    $event->description = $request->input('description');

    // Ensure incharge_id is set to the logged-in in-charge ID
    $event->incharge_id = $LoggedInchargeInfo->id;

    // Get the current date
    $today = \Carbon\Carbon::today();

    // Check if the new end date is in the future, and update the status accordingly
    if (\Carbon\Carbon::parse($event->end_date)->gt($today)) {
        $event->status = 'In Progress';
    }

    // Save the event
    $event->save();

    // Handle projects association
    $event->projects()->sync($request->input('projects', []));

    // Redirect back with a success message
    return redirect()->route('incharge.events')->with('success', 'Event updated successfully.');
}

    

    public function destroy($id)
    {
        try {
            // Find the event by its ID
            $event = Event::findOrFail($id);
    
            // Delete the event
            $event->delete();
    
            // Return a success response
            return response()->json([
                'message' => 'Event deleted successfully!'
            ], 200);
        } catch (\Exception $e) {
            // Log the error to your Laravel logs
            \Log::error('Error deleting event: ' . $e->getMessage());
    
            // Return an error response with the exception message
            return response()->json([
                'error' => 'There was a problem deleting the event.'
            ], 500);
        }
    }
    
}
 
