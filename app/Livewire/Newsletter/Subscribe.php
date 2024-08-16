<?php

namespace App\Livewire\Newsletter;

use App\Actions\Newsletter\EmailSubscriber;
use App\Mail\SubscriberMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Newsletter\Facades\Newsletter;

class Subscribe extends Component
{
    public string $email = '';

    protected $rules = [
        'email' => 'required|email|unique:subscribers',
    ];

    public function formSubmit()
    {
        $this->validate();

        $token = bcrypt($this->email);

        $data = array(
            'email' => $this->email,
        );

        (new EmailSubscriber)([
            'email' => $this->email,
            'token' => $token,
        ]);

        // if (!Newsletter::isSubscribed($this->email)) {
        //     Newsletter::subscribe($this->email, ['TOKEN' => $token]);
        // }

        Mail::to($this->email)
            ->send(new SubscriberMailable($data));

        session()->flash('success', 'You are subscribed successfully!');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.newsletter.subscribe');
    }
}
