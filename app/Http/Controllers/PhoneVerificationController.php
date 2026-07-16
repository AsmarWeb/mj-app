<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Illuminate\Http\Request;

class PhoneVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-phone');
    }

    public function send(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        auth()->user()->update([
            'phone' => $request->phone,
        ]);

        $client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );

        $client->verify->v2
            ->services(config('services.twilio.verify_sid'))
            ->verifications
            ->create($request->phone, 'sms');

        return back()->with('codeSent', true);
    }

    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );

        $verification = $client->verify->v2
            ->services(config('services.twilio.verify_sid'))
            ->verificationChecks
            ->create([
                'to' => auth()->user()->phone,
                'code' => $request->code,
            ]);

        if ($verification->status == 'approved') {

            auth()->user()->update([
                'phone_verified_at' => now(),
            ]);

            return redirect()
                ->route('profile.show')
                ->with('success', 'Phone verified successfully.');
        }

        return back()->withErrors([
            'code' => 'Invalid verification code.',
        ]);
    }
}
