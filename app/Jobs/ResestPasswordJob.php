<?php

namespace App\Jobs;

use App\Mail\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ResestPasswordJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }



    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->data['email'])->send(new ResetPassword($this->data));
    }
}
