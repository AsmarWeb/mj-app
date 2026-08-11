<?php

namespace App\Mail;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class SubscriptionDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Subscription $subscription;
    public ?Plan $plan;
    public string $cancelUrl;

    public function __construct(
        User $user,
        Subscription $subscription,
        ?Plan $plan
    ) {
        $this->user = $user;
        $this->subscription = $subscription;
        $this->plan = $plan;

        /*
         * Create a signed cancellation URL.
         *
         * The URL expires after 7 days.
         */
        $this->cancelUrl = URL::temporarySignedRoute(
            'subscription.cancel',
            now()->addDays(7),
            [
                'subscription' => $subscription->id,
            ]
        );
    }

    public function build()
    {
        return $this
            ->from(
                config('mail.from.address'),
                config('mail.from.name')
            )
            ->to($this->user->email, $this->user->name)
            ->subject('Your murwaj Subscription Details')
            ->view('emails.subscription-details');
    }
}