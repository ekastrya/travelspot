<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class KirimPesanService
{
    public static function login()
    {
        $client = new Client();
        $request = $client->post(env('KIRIM_PESAN_BASE_URL').'/client/login', [
            'body' => json_encode([
                'uid' => env('KIRIM_PESAN_UID'),
                'pass' => env('KIRIM_PESAN_PWD')
            ])
        ]);
        $response = $request->getBody()->getContents();

        return json_decode($response,true);
    }

    public static function send_text($token, $phone, $text)
    {
        $formatted_text = $text;
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://apiks.ristekmuslim.com/client/v1/message/send-text",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>json_encode([
            'instanceID' => env('KIRIM_PESAN_INSTANCE_ID'), //: "<your instance id>",
            'phone' => $phone, //: "<phone number with internasional code, exmp: 62812345679>",
            'message' => $formatted_text, //: "Testing message",
            'serverSend' => 'false' //: "false"
        ]), //"{\n  \"instanceID\": \"<your instance id>\",\n  \"phone\": \"<phone number with internasional code, exmp: 62812345679>\",\n  \"message\": \"Testing message\",\n  \"serverSend\": \"false\"\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".$token,
            "Content-Type: application/json",
            "Content-Type: text/plain"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function logout($token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => env('KIRIM_PESAN_BASE_URL')."/client/logout",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".$token,
            "Content-Type: application/json"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
