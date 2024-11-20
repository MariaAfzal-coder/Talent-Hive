<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class StudentMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $receiver_id;
    public $sender_id;

    public function __construct($message, $receiver_id, $sender_id)
    {
        $this->message = $message;
        $this->receiver_id = $receiver_id;
        $this->sender_id = $sender_id;
    }

    public function broadcastOn()
    {
        return new Channel('doctor-messages'); // Adjust channel name as needed
    }

    public function broadcastAs()
    {
        return 'message.sent'; // Optional: specify an event name
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'created_at' => now(), // You can format this as needed
        ];
    }
}