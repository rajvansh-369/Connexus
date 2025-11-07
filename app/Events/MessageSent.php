<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast  // MUST implement this
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $messageArr;

    public function __construct($message)
    {
        $this->messageArr = $message;
        // dd($message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {

        return [
            // new PrivateChannel('chat.' . $this->messageArr['to_user_id']),
            // new PrivateChannel('chat.' . $this->messageArr['from_user_id']),
            new PrivateChannel('chat.' . $this->messageArr['chat_id']),
        ];
    }


    public function broadcastWith(): array
    {
        return ['message' => $this->messageArr];
    }
}
