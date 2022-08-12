<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<string>
     */
    public function via(): array
    {
        return ['mail'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string>
     */
    public function toArray(): array
    {
        return [
            //
        ];
    }
}
