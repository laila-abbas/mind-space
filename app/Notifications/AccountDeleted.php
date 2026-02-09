<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class AccountDeleted extends Notification 
{
    use Queueable;

    public function __construct()
    {
        
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $restoreUrl = URL::temporarySignedRoute(
            'account.restore',       // route name
            now()->addDays(14),      // expiration
            ['user' => $notifiable->id] // route parameters
        );

        return (new MailMessage)
            ->subject(__('notifications.account_deleted_subject'))
            ->line(__('notifications.account_deleted_line_1'))
            ->line(__('notifications.account_deleted_line_2'))
            ->action(__('notifications.restore_account'), $restoreUrl)
            ->line(__('notifications.account_deleted_line_3'));
    }
}
