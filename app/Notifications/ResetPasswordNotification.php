<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $expireMinutes = config(
            'auth.passwords.' . config('auth.defaults.passwords') . '.expire',
            60
        );

        return (new MailMessage)
            ->subject('Reset Password - Solipet')
            ->view('auth.passwords.reset-email', [
                'url' => $url,
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
                'user' => $notifiable,
                'expireMinutes' => $expireMinutes,
            ]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}