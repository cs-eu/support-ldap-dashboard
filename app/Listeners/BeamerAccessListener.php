<?php

namespace App\Listeners;

use App\Events\BeamerAccessEvent;
use App\Models\BeamerAccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BeamerAccessListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BeamerAccessEvent $event): void
    {
        BeamerAccess::create([
            'name' => $event->name,
            'email' => $event->email,
            'accessed_at' => now(),
        ]);
    }
}
