<?php

namespace App\Services;

class Whatsapp
{
  public const TOKEN = 'y5gz13le8fz1am2e';
  public const INSTANCE_ID = 'instance63194';

  // public static function send($phone, $message)
  // {
  //     $phone_id = env('META_PHONE_ID');
  //     $token = env('META_TOKEN');

  //     $curl = curl_init();
  //     curl_setopt_array($curl, array(
  //         CURLOPT_URL => 'https://graph.facebook.com/v15.0/' . $phone_id . '/messages',
  //         CURLOPT_RETURNTRANSFER => true,
  //         CURLOPT_ENCODING => '',
  //         CURLOPT_MAXREDIRS => 10,
  //         CURLOPT_TIMEOUT => 0,
  //         CURLOPT_FOLLOWLOCATION => true,
  //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //         CURLOPT_CUSTOMREQUEST => 'POST',
  //         CURLOPT_POSTFIELDS => '{
  //             "messaging_product": "whatsapp",
  //             "to": ' . $phone . ',
  //             "type": "template",
  //             "template": {
  //                 "name": "hello_world",
  //                 "language": {
  //                     "code": "en_US"
  //                 }
  //             }
  //         }',
  //         CURLOPT_HTTPHEADER => array(
  //             'Authorization: Bearer ' . $token,
  //             'Content-Type: application/json'
  //         ),
  //     ));

  //     $response = curl_exec($curl);

  //     curl_close($curl);

  //     return $response;
  // }

  public static function send($phone, $message)
  {
    $str1 = substr($phone, 1);
    $phone = '966' . $str1;
    $params = [
      'token' => self::TOKEN,
      'to' => $phone,
      'body' => $message
    ];
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.ultramsg.com/" . self::INSTANCE_ID . "/messages/chat",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => http_build_query($params),
      CURLOPT_HTTPHEADER => [
        "content-type: application/x-www-form-urlencoded"
      ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    /* if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              echo $response;
            } */
  }

  public static function sendWithImage($phone, $message, $image)
  {
    $str1 = substr($phone, 1);
    $phone = '966' . $str1;
    $params = [
      'token' => self::TOKEN,
      'to' => $phone,
      'image' => $image, // image path will not work on local
      'caption' => $message,
      'priority' => '',
      'referenceId' => '',
      'nocache' => '',
      'msgId' => '',
      'mentions' => ''
    ];
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.ultramsg.com/" . self::INSTANCE_ID . "/messages/image",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => http_build_query($params),
      CURLOPT_HTTPHEADER => [
        "content-type: application/x-www-form-urlencoded"
      ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    /*  if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        } */
  }
}
