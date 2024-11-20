<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompanyMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $senderId;
    public $receiverId;
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($senderId, $receiverId, $message)
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('company-chat');
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId, // Added receiverId here
            'message' => $this->message,
            'created_at' => now()->toDateTimeString(),
        ];
    }
}
