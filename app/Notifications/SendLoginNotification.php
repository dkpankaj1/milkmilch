<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendLoginNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $ip;
    protected $dateTime;
    protected $deviceDetails;
    /**
     * Create a new notification instance.
     */
    public function __construct($user,$ip, $deviceDetails)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->dateTime = now();
        $this->deviceDetails = $deviceDetails;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Account Login')
            ->subject("Login Notification")
            ->line('You have successfully logged in.')
            ->line('IP Address: ' . $this->ip)
            ->line('Date and Time: ' . $this->dateTime)
            ->line('Device Details: ' . $this->deviceDetails)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
