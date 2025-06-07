<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArtisanEmailVerification extends Notification
{
    use Queueable;

    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
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
        $verificationUrl = url('/artisan/email/verify/' . $this->token);
        
        return (new MailMessage)
                    ->subject('メールアドレスの確認')
                    ->line('職人アカウントの登録ありがとうございます。')
                    ->line('以下のボタンをクリックしてメールアドレスを確認してください。')
                    ->action('メールアドレスを確認', $verificationUrl)
                    ->line('このリンクは24時間有効です。');
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
