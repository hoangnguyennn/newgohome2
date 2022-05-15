<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $type = $this->data['type'];
        $link = $this->data['link'];

        if ($type == 3) {
            $subject = 'Yêu cầu duyệt bài';
            $content = 'Có một bài đăng mới đang chờ duyệt.';
        } else {
            $subject = 'Bài đăng đã được duyệt';
            $content = 'Có một bài đăng mới đã được duyệt.';
        }

        return (new MailMessage)
            ->greeting('Xin chào!')
            ->subject($subject)
            ->line($content)
            ->action('Xem danh sách bài đăng', $link);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->data;
    }
}
