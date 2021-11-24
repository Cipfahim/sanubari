<?php

use bulk360\client;

if (!function_exists('sendOtp')) {

    /**
     * description
     *
     * @param $phone
     * @param $otp_code
     * @return void
     */
    function sendOtp($phone, $otp_code)
    {
        $smsClient = new Client(env('BULK360_KEY'),env('BULK360_SECRET'));
        $appUrl = config('app.url');

        $smsClient->send([
            'from' => '68068',
            'to' => $phone,
            'text' => "Your $appUrl login otp is: $otp_code. Please don't share your opt with anyone. Thanks"
        ]);
    }
}

if (!function_exists('sendPassword')) {

    /**
     * description
     *
     * @param $phone
     * @param $password
     * @return void
     */
    function sendPassword($phone, $password)
    {
        $smsClient = new Client(env('BULK360_KEY'),env('BULK360_SECRET'));
        $appUrl = config('app.url');

        $smsClient->send([
            'from' => '68068',
            'to' => $phone,
            'text' => "Your $appUrl login password is: $password. Please don't share your password with anyone. Thanks"
        ]);
    }
}
