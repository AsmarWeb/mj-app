<?php

namespace App\Notifications;

use App\Models\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShopCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Shop $shop)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Shop created successfully!',
            'message' => "Your shop '{$this->shop->name}' is now live.",
            'icon' => 'check-circle',
            'color' => 'green',
            'url' => route('shop.edit'),
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Your shop is ready!')
                    ->greeting('Congratulations!')
                    ->line("Your shop '{$this->shop->name}' has been created successfully.")
                    ->action('Manage Shop', route('shop.edit'))
                    ->line('Thank you for using our platform.');
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
