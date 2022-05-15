<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostRequestNotification extends Notification
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

        if ($type == 1) {
            $subject = 'Yêu cầu tìm nhà';
            $content = 'Có một yêu cầu tìm nhà mới cần được xử lý.';
        } else if ($type == 2) {
            $subject = 'Yêu cầu gửi nhà';
            $content = 'Có một yêu cầu gửi nhà mới cần được xử lý.';
        } else {
            $subject = 'Yêu cầu hỗ trợ';
            $content = 'Có một yêu cầu hỗ trợ mới cần được xử lý.';
        }

        return (new MailMessage)
            ->greeting('Xin chào!')
            ->subject($subject)
            ->line($content)
            ->action('Xem danh sách yêu cầu', $link);
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
