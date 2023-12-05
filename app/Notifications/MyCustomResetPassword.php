<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MyCustomResetPassword extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        //
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('3tpan@example.com', '3tpan')
            ->subject('パスワードリセットのお知らせ') // Thay đổi tiêu đề email
            ->greeting('こんにちは！')
            ->line('このメールは、あなたのアカウントのパスワードリセット要求があったため送信されています。')
            ->action('パスワードをリセットする', url('/password/reset/' . $this->token))
            ->line('もしパスワードのリセットを要求していない場合は、何もする必要はありません。')
            ->salutation('敬具,')
            ->salutation(config('app.name'));
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
