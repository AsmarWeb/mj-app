<?php

namespace App\Livewire\Newsletter;

use App\Mail\SubscriberMailable;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Subscribe extends Component
{
    public string $email = '';

    protected $rules = [
        'email' => 'required|string|regex:/^([a-z0-9+-]+)(.[a-z0-9+-]+)*@([a-z0-9-]+.)+[a-z]{2,6}$/ix|email:rfc,dns,filter|max:255|unique:subscribers',
    ];

    public function formSubmit()
    {
        $this->validate();

        $token = Hash::make($this->email);

        $subscriber = Subscriber::create([

            'email' => $this->email,

            'token' => $token,

            'active' => true,

        ]);

        // if (!Newsletter::isSubscribed($this->email)) {
        //     Newsletter::subscribe($this->email, ['TOKEN' => $token]);
        // }

        Mail::to($this->email)
            ->send(
                new SubscriberMailable([
                    'email' => $this->email
                ])
            );
            
        session()->flash('success', 'You are subscribed successfully!');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.newsletter.subscribe');
    }
}
