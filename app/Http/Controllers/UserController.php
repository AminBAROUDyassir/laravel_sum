<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function get_users()
    {
        $url = "https://staging-market.yassir.io/api/4.0/yassirpay_history/228";

        //$token = base64_encode("amin.baroud@yassir.io:QbT227QtJBUq4wg6xRMR6nL344OF85sd");
        $token = base64_encode("hani.cherif@yassir.io:a97J1i54KmBVdlZ4ko8e0q6MgPc73XY0");
        $authHeaderString = 'Authorization: Basic ' . $token;

        info($token);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            $authHeaderString)
        );

        $response = curl_exec($ch);
        return response($response)
            ->header('Content-Type', 'json');

        //return $response;

        curl_close($ch);

    }
}
