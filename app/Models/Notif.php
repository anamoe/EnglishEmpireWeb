<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif
{


    public function sendNotifOne($token, $pesan, $judul)
    {
        $array = array(
            "to" => $token,
            // "registration_ids" => $token,
            "data" => ["body" => $pesan, "title" => $judul],
        );
        $field = json_encode($array);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $field,
            CURLOPT_HTTPHEADER => array(
                'Authorization: key
                =AAAAGd0tx5U:APA91bHL1PWaMPOUwNkR_Cw8XaLtMP-Nj0lGcbpXZ_HGDp44y9SycDWNZW4mZorbTZImfsAjRZNGujjAv_BgkFJpyE75acmF678Tp8mxRDG0MZbB1N_a5cnF8oLYMS49vCKiRqboIj3q',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        // return $response;
	
    }
    public function sendNotifAll($token, $pesan, $judul)
    {
        $array = array(
            // "to" => $token,
            "registration_ids" => $token,
            "data" => ["body" => $pesan, "title" => $judul],
        );
        $field = json_encode($array);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $field,
            CURLOPT_HTTPHEADER => array(
                'Authorization: key=AAAAqk6eu-E:APA91bFo-mk7B0w7XyOSSq_35yhAOd5-_BRHf_GcUFGKCJwSXDvEJtkHIZnjSLCFjIR4nGvErSox2ci1q1m_V31Cw724-JB_5tJNa7JNUSl-GtVq5vyRv-CCAHrF8ePAnR_sCHeJYQRR',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        // return $response;
	
    }
   
   
}
