<?php

namespace App\Library;

trait CaptchaChecker
{
    public function checkCaptcha($request)
    {
        $captcha_secret_key = config('services.google_captcha.secret_key');
        $grecaptcharesponse = $request->invisibleCaptcha;
        $url = "https://www.google.com/recaptcha/api/siteverify?";
        $myvars = $url . 'secret=' . $captcha_secret_key . '&response=' . $grecaptcharesponse;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $myvars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($output);

        return $response;
    }
}
