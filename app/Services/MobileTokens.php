<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class MobileTokens
{
    public function query(User $user)
    {
        return $user->tokens()->where('name', 'like', 'mobile:%')->whereJsonContains('abilities', 'mobile:account');
    }

    // Call while holding the user row lock so concurrent logins cannot exceed the cap.
    public function issue(User $user, string $device): array
    {
        $this->query($user)->whereNotNull('expires_at')->where('expires_at', '<=', now())->delete();
        if ($this->query($user)->count() >= 20) {
            throw ValidationException::withMessages(['device_name' => 'Too many active devices. Revoke a mobile token from an existing device first.']);
        }
        $expires = now()->addDays(30);
        $token = $user->createToken('mobile:'.$device, ['mobile:account'], $expires);

        return ['access_token' => $token->plainTextToken, 'token_type' => 'Bearer', 'expires_at' => $expires->toISOString()];
    }
}
