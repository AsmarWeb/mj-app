<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the selected social provider.
     */
    public function redirect(string $provider)
    {
        abort_unless(
            in_array($provider, ['google', 'facebook'], true),
            404
        );

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle the callback from the social provider.
     */
    public function callback(string $provider)
    {
        abort_unless(
            in_array($provider, ['google', 'facebook'], true),
            404
        );

        $socialUser = Socialite::driver($provider)->user();

        /*
        |--------------------------------------------------------------------------
        | Email
        |--------------------------------------------------------------------------
        */

        $email = $socialUser->getEmail();

        // Social login should not continue without a verified email.
        if (! $email) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Unable to retrieve your email address from ' .
                        ucfirst($provider) .
                        '. Please try another login method.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | User
        |--------------------------------------------------------------------------
        */

        $user = User::updateOrCreate(
            [
                'email' => $email,
            ],
            [
                'name' => $socialUser->getName()
                    ?? $socialUser->getNickname()
                    ?? 'User',

                // Social users do not need to know this password.
                'password' => bcrypt(Str::random(32)),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Profile Photo
        |--------------------------------------------------------------------------
        */

        if (! $user->profile_photo_path && $socialUser->getAvatar()) {
            try {
                $response = Http::timeout(10)
                    ->get($socialUser->getAvatar());

                if ($response->successful()) {
                    $filename = 'profile-photos/' . Str::uuid() . '.jpg';

                    Storage::disk('public')->put(
                        $filename,
                        $response->body()
                    );

                    $user->profile_photo_path = $filename;
                    $user->save();
                }
            } catch (\Throwable $e) {
                // Do not prevent login if the provider's avatar cannot be downloaded.
            }
        }

        /*
        |--------------------------------------------------------------------------
        | User Role
        |--------------------------------------------------------------------------
        */

        if (! $user->hasRole('user')) {
            $user->addRole('user');
        }

        /*
        |--------------------------------------------------------------------------
        | Login
        |--------------------------------------------------------------------------
        */

        Auth::login($user, true);

        request()->session()->regenerate();

        return redirect()->intended('/profile');
    }
}
