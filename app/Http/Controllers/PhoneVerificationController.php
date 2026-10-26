<?php

namespace App\Http\Controllers;

use App\Services\PhoneVerification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PhoneVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-phone');
    }

    public function send(Request $request, PhoneVerification $verification)
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

            $verification->send($phone);

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
                'Phone verification send failed.', ['exception_type' => get_class($e)]
            );

            return back()

                ->withErrors([

                    'phone' => 'Unable to send a verification code. Please try again later.',

                ])

                ->with(
                    'codeSent',
                    false
                );

        }

    }

    public function check(Request $request, PhoneVerification $verification)
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

            if ($verification->approved($user->phone, $request->string('code')->toString())) {

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

                'Phone verification check failed.', ['exception_type' => get_class($e)]

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
