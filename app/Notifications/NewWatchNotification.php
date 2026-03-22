<?php

namespace App\Notifications;

use App\Models\Watch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewWatchNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $watch;

    public function __construct(Watch $watch)
    {
        $this->watch = $watch;
    }

    public function via($notifiable): array
    {
        $via = ['database']; // Always log to database bell
        
        // Check if user has enabled email for new products
        $settings = $notifiable->notificationSetting;
        if ($settings && $settings->email_new_product) {
            $via[] = 'mail';
        }

        return $via;
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Arrival: ' . $this->watch->name)
                    ->greeting('Hello ' . $notifiable->name . '!')
                    ->line('A new luxury timepiece has arrived in our collection: ' . $this->watch->name)
                    ->line('Brand: ' . $this->watch->brand)
                    ->line('Price: $' . number_format($this->watch->price))
                    ->action('Discover Now', url('/watch/' . $this->watch->id))
                    ->line('Thank you for being a part of of Haute Horlogerie!');
    }

    public function toArray($notifiable): array
    {
        return [
            'watch_id' => $this->watch->id,
            'title' => 'New Timepiece',
            'message' => $this->watch->name . ' by ' . $this->watch->brand . ' is now available.',
            'url' => route('watches.show', $this->watch->id, false),
            'image' => $this->watch->image
        ];
    }
}
