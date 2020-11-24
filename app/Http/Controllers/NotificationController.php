<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification(){
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token= ['edckeUrkRRGyueJYjWv22_:APA91bHF2wKazgGQjlKiD7LQtL431FAwKCl1at9wiuSfnVpdKBI9744ubZLQDNFerB5wzYJmKmEtuqoKbxBdaeQ0mYOHmFkxCIZsCaMkbPsQuJW8MIUGDKqRiHaUKwixYF5UHsjbzdrS','cNG4rAdsSTSt0CaatB1hhr:APA91bGcbe3GIQF91BZxQiKWvbS_kYrUmE6ohO5NihvQzNpXXg_v-ebUofwdWYvMSFxkTLCStb097lTz4HhtyRuaNUP61YRlu8r2MuhCUrdF1NS4qAsBxovmQsIYI2wMjaSGme3J0Rr2'];

        $notification = [
            'title' => 'test notification',
            "body" => "You have won a car \n test test test \n test test test \n test test test \n test test test",
            'sound' => true,
        ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            'registration_ids' => $token, //multple token array
            //'to'        => $token, //single token
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
