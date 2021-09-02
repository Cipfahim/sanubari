<?php

use bulk360\client;

if (!function_exists('sendOtp')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function sendOtp($phone, $otp_code)
    {
        $smsClient = new Client(env('BULK360_USERNAME'), env('BULK360_PASSWORD'));

        $appUrl = config('app.url');

        $smsClient->send([
            'from' => '68068',
            'to' => $phone,
            'text' => "Your $appUrl login otp is: $otp_code. Please don't share your opt with anyone. Thanks"
        ]);
    }
}
