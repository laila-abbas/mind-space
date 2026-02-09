<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class RestoreAccountNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
        $restoreUrl = URL::temporarySignedRoute(
            'account.restore',       
            now()->addDays(14),      
            ['user' => $notifiable->id] 
        );
        return (new MailMessage)
            ->subject(__('notifications.restore_account_subject'))
            ->line(__('notifications.restore_account_line_1'))
            ->line(__('notifications.restore_account_line_2'))
            ->action(__('notifications.restore_account_action'), $restoreUrl)
            ->line(__('notifications.restore_account_line_3'));
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
