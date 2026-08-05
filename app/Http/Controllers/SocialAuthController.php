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
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate(
            [
                'email' => $socialUser->getEmail(),
            ],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'password' => bcrypt(Str::random(16)),
            ]
        );

        // Only save the profile photo if the user doesn't already have one

        if (! $user->profile_photo_path && $socialUser->getAvatar()) {
            $contents = Http::get($socialUser->getAvatar())->body();
            $filename = 'profile-photos/'.Str::uuid().'.jpg';
            Storage::disk('public')->put($filename, $contents);
            $user->profile_photo_path = $filename;
            $user->save();
        }

        // Every user should have the "user" role
        if (! $user->hasRole('user')) {
            $user->addRole('user');
        }

        Auth::login($user);

        return redirect('/profile');
    }
}
