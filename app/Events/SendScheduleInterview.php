<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\InterviewSchedule; // Correct model import
use App\Models\Company;

class SendScheduleInterview implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $interview;
    public $company;
    public $studentId;

    public function __construct(InterviewSchedule $interview, Company $company)
    {
        $this->interview = $interview;
        $this->company = $company;
        $this->studentId = $interview->student_id; // Get the student ID
    }

    public function broadcastOn()
    {
        // Change to a public channel
        return new Channel('student.' . $this->studentId);
    }

    public function broadcastWith()
    {
        return [
            'interview' => $this->interview,
            'company' => $this->company,
        ];
    }

    public function broadcastAs()
    {
        return 'schedule-interview'; // Keep the event name as is
    }
}