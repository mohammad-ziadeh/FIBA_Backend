<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatingEventNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;


    public function __construct($event,)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "A new event has been created: {$this->event->title}",
            'event_id' => $this->event->id,
            'event_title' => $this->event->title,
            'start_date' => $this->event->start_date->toDateTimeString(),
            'end_date' => $this->event->end_date->toDateTimeString(),
        ];
    }
}
