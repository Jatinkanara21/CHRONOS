<?php

namespace App\Notifications;

use App\Models\Watch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PriceDropNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $watch;
    protected $oldPrice;

    public function __construct(Watch $watch, $oldPrice)
    {
        $this->watch = $watch;
        $this->oldPrice = $oldPrice;
    }

    public function via($notifiable): array
    {
        $via = ['database'];
        
        $settings = $notifiable->notificationSetting;
        if ($settings && $settings->email_price_drop) {
            $via[] = 'mail';
        }

        return $via;
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Price drop: ' . $this->watch->name)
                    ->greeting('Hello ' . $notifiable->name . '!')
                    ->line('Great news! A watch on your radar has dropped in price.')
                    ->line('Timepiece: ' . $this->watch->name)
                    ->line('Previous Price: $' . number_format($this->oldPrice))
                    ->line('New Price: $' . number_format($this->watch->price))
                    ->action('View Deal', url('/watch/' . $this->watch->id))
                    ->line('Act fast as stock may be limited.');
    }

    public function toArray($notifiable): array
    {
        return [
            'watch_id' => $this->watch->id,
            'title' => 'Price Drop Alert',
            'message' => $this->watch->name . ' is now back with special pricing: $' . number_format($this->watch->price),
            'url' => route('watches.show', $this->watch->id, false),
            'image' => $this->watch->image
        ];
    }
}
