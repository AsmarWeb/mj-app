<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Exception;

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


        $user = auth()->user();


        // Save phone and reset verification if phone changed
        if ($user->phone !== $request->phone) {

            $user->forceFill([
                'phone' => $request->phone,
                'phone_verified_at' => null,
            ])->save();

        }


        try {

            $client = new Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );


            $client->verify->v2
                ->services(config('services.twilio.verify_sid'))
                ->verifications
                ->create(
                    $request->phone,
                    'sms'
                );


            return back()->with(
                'codeSent',
                true
            );


        } catch (Exception $e) {


            Log::error(
                'Twilio phone verification error: '.$e->getMessage()
            );


            return back()->withErrors([
                'phone' => 'Unable to send verification code. Please try again.',
            ]);
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


        if (!$user->phone) {

            return back()->withErrors([
                'code' => 'Phone number is missing.',
            ]);

        }



        try {

            $client = new Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );


            $verification = $client->verify->v2
                ->services(config('services.twilio.verify_sid'))
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
            ]);



        } catch (Exception $e) {


            Log::error(
                'Twilio verification check error: '.$e->getMessage()
            );


            return back()->withErrors([
                'code' => 'Verification failed. Please try again.',
            ]);

        }
    }
}