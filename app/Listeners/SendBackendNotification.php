<?php

namespace App\Listeners;

use App\Events\BackendNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBackendNotification
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
     * @param  \App\Events\BackendNotification  $event
     * @return void
     */
    public function handle(BackendNotification $event)
    {
        $notif_title = $event->title;
        $notif_message = $event->message;
    }
}
