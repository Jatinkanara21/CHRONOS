<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $title;
    protected $messageContent;
    protected $url;
    protected $image;

    public function __construct($title, $messageContent, $url = null, $image = null)
    {
        $this->title = $title;
        $this->messageContent = $messageContent;
        $this->url = $url;
        $this->image = $image;
    }

    public function via($notifiable): array
    {
        // For custom admins, generally always broadcast both unless they select otherwise
        return ['database', 'mail']; 
    }

    public function toMail($notifiable): MailMessage
    {
        $mail = (new MailMessage)
                    ->subject($this->title)
                    ->greeting('Hello ' . $notifiable->name . '!')
                    ->line($this->messageContent);

        if ($this->url) {
            $mail->action('Discover More', url($this->url));
        }

        return $mail;
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => $this->title,
            'message' => $this->messageContent,
            'url' => $this->url ?? '#',
            'image' => $this->image
        ];
    }
}
