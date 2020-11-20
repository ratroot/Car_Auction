<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification(){
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token='eJKd54ZRTlqdXTMROOx-5w:APA91bHsk_w28U2-V2xG22WjoQLsn_E-c_K7F5GGISVXPMBfWohhx99Vyy1P_YFOSJMnQeei5pni0-1mJkbZua8ZcNa3dZZsk6vxE-eTgX66zKvYyGITdE2Wfy7agMjH19A7doEFpifN';

        $notification = [
            'title' => 'test notification',
            "body" => "You have won a car!!",
            'sound' => true,
        ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AAAALr46epo:APA91bEKIHu62RwzNibChNrBeLhi6hfKh-S3fPtl20lWtjeqBn98ckdObc9--OVlyb-PwRvnWUU0viO7WsIimOFUvKUF3fHUJCLCcfwZ2TGkfnunW0qZ-jVsllnao6WAz1TJdkRTQhpw',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
