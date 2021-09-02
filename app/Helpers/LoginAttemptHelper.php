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
        $smsClient = new Client('JX7axGreyv', 'COERq7zZC9EtKWvxrXvUCr18HxIOd3oMKWTEUuHd');

        $smsClient->send([
            'from' => '68068',
            'to' => $phone,
            'text' => $otp_code
        ]);
    }
}
