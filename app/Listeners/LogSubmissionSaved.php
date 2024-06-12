<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;

class LogSubmissionSaved
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SubmissionSaved $event
     * @return void
     */
    public function handle(SubmissionSaved $event)
    {
        Log::info('Submission saved:', ['name' => $event->submission->name, 'email' => $event->submission->email]);
    }
}
