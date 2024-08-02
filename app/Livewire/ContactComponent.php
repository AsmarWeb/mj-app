<?php

namespace App\Livewire;

use App\Mail\ContactMailable;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactComponent extends Component
{
    public string $fullname = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';

    protected $rules = [
        'fullname' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'message' => 'required'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function sendMessage()
    {
        $this->validate();

        $contact = new Contact();
        $contact->fullname = $this->fullname;
        $contact->email = $this->email;
        $contact->phone = $this->phone;
        $contact->message = $this->message;

        $contact->save();

        $this->sendContactConfirmationMail($contact);
        session()->flash('message', 'Thanks, Your message has been sent successfully!');
        return $this->redirect('/contact-us');
        $this->resetFields();
    }

    public function sendContactConfirmationMail($contact)
    {
        Mail::to($contact->email)->send(new ContactMailable($contact));
    }

    public function render()
    {
        return view('livewire.contact-component');
    }

    private function resetFields()
    {
        $this->fullname = '';
        $this->email = '';
        $this->phone = '';
        $this->message = '';
    }
}
