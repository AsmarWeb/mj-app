<?php

namespace App\Notifications;

use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ListingCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Listing $listing)
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
            'title' => '📦 Product Published',
            'message' => "\"{$this->listing->title}\" has been published successfully.",
            'icon' => 'order',
            'url' => route('profile'),
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('📦 Your Product Has Been Published')
        
                    ->greeting('Hello ' . $notifiable->name . ',')
        
                    ->line('Great news! Your product has been published successfully.')
        
                    ->line('**' . $this->listing->title . '** is now live and visible to users.')
        
                    ->action('View My Listings', route('profile'))
        
                    ->line('Thank you for using our platform!');
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
