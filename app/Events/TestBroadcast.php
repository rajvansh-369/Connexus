<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestBroadcast implements ShouldBroadcast  // MUST implement this
{
    use Dispatchable, SerializesModels;

    public $message;

    public function __construct($message)
    {
        \Log::info('TestBroadcast event created with message: ' . $message);
        $this->message = $message;
    }

    public function broadcastOn()
    {
        \Log::info('broadcastOn() called');
        return new Channel('test-channel');
    }

    public function broadcastAs()
    {
        return 'TestBroadcast';
    }
}
