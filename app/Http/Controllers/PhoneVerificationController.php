<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class PhoneVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-phone');
    }

    public function send(Request $request)
    {

        $request->validate([

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

        ]);

        $phone = preg_replace('/\s+/', '', $request->phone);

        $user = auth()->user();

        // Already verified
        if ($user->phone_verified_at && $user->phone === $phone) {

            return back()->with(
                'success',
                'Your phone number is already verified.'
            );

        }

        try {

            $client = new Client(

                config('services.twilio.sid'),

                config('services.twilio.token')

            );

            $client->verify
                ->v2
                ->services(
                    config('services.twilio.verify_sid')
                )
                ->verifications
                ->create(

                    $phone,

                    'sms'

                );

            /*
            Save phone only after Twilio accepts request
            */

            $user->forceFill([

                'phone' => $phone,

                'phone_verified_at' => null,

            ])->save();

            return back()
                ->with(
                    'codeSent',
                    true
                )
                ->with(
                    'success',
                    'Verification code sent successfully.'
                );

        } catch (Exception $e) {

            Log::error(
                'Twilio send error: '.$e->getMessage()
            );

            return back()

                ->withErrors([

                    'phone' => $e->getMessage(),

                ])

                ->with(
                    'codeSent',
                    false
                );

        }

    }

    public function check(Request $request)
    {

        $request->validate([

            'code' => [

                'required',

                'digits:6',

            ],

        ]);

        $user = auth()->user();

        if (! $user->phone) {

            return back()->withErrors([

                'code' => 'Phone number not found.',

            ]);

        }

        try {

            $client = new Client(

                config('services.twilio.sid'),

                config('services.twilio.token')

            );

            $verification = $client->verify

                ->v2

                ->services(
                    config('services.twilio.verify_sid')
                )

                ->verificationChecks

                ->create([

                    'to' => $user->phone,

                    'code' => $request->code,

                ]);

            if ($verification->status === 'approved') {

                $user->forceFill([

                    'phone_verified_at' => now(),

                ])->save();

                return redirect()

                    ->route('profile.show')

                    ->with(

                        'success',

                        'Phone verified successfully.'

                    );

            }

            return back()->withErrors([

                'code' => 'Invalid verification code.',

            ])
                ->with(
                    'codeSent',
                    true
                );

        } catch (Exception $e) {

            Log::error(

                'Twilio verify error: '.$e->getMessage()

            );

            return back()

                ->withErrors([

                    'code' => 'Verification failed. Please try again.',

                ])

                ->with(

                    'codeSent',

                    true

                );

        }

    }
}
