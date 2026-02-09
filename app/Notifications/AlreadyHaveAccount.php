<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlreadyHaveAccount extends Notification 
{
    use Queueable;

    public function __construct()
    {
        
    }

    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('notifications.already_have_account_subject'))
            ->line(__('notifications.already_have_account_line1'))
            ->action(__('notifications.already_have_account_action'), route('login'))
            ->line(__('notifications.already_have_account_line2'));
    }
}
