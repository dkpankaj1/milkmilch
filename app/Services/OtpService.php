<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Otp;

class OtpService
{
    private $otpLength;
    private $otpValid;

    public function __construct()
    {
        $this->otpLength = config('otp.length', 6);
        $this->otpValid = config('otp.validity', 10);
    }

    public function store(string $identifier): object
    {
        Otp::where('identifier', $identifier)->where('valid', true)->delete();

        $token = $this->generate();

        Otp::create([
            'identifier' => $identifier,
            'token' => $token,
            'validity' => $this->otpValid,
        ]);

        return (object) [
            'status' => true,
            'token' => $token,
            'validity' => $this->otpValid,
            'message' => 'OTP generated',
        ];
    }

    public function validate(string $identifier, string $token): object
    {
        $now = Carbon::now();
    
        $result = Otp::where('identifier', $identifier)
            ->where('token', $token)
            ->where('valid', true)
            ->where('created_at', '>', $now->subMinutes(config('otp.validity')))
            ->update(['valid' => false]);
    
        if ($result > 0) {
            return (object) [
                'status' => true,
                'message' => 'OTP is valid',
            ];
        }
    
        return (object) [
            'status' => false,
            'message' => $result === 0 ? 'OTP does not exist' : 'OTP Expired',
        ];
    }
    

    public function generate(): string
    {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < $this->otpLength; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
