<?php

namespace App\Services;

use Twilio\Rest\Client;

class PhoneVerification
{
    public function send(string $phone): void
    {
        $this->client()->verify->v2->services(config('services.twilio.verify_sid'))
            ->verifications->create($phone, 'sms');
    }

    public function approved(string $phone, string $code): bool
    {
        $verification = $this->client()->verify->v2->services(config('services.twilio.verify_sid'))
            ->verificationChecks->create(['to' => $phone, 'code' => $code]);

        return $verification->status === 'approved';
    }

    private function client(): Client
    {
        return new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }
}
