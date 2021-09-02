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

        $smsClient->send([
            'from' => '68068',
            'to' => $phone,
            'text' => $otp_code
        ]);
    }
}
