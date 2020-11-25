<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification(Request $request){

        $id = $request->ids;
        //foreach($ids as $id){

        $all_data =  DB::select("SELECT bidding.latestBid, bidding.userID, bidding.userDeviceID, auctions.id as auctionID, auctions.Make, auctions.Model, auctions.ExactModel, auctions.Year ".
                                "FROM bidding ".
                                "LEFT JOIN auctions on bidding.auctionID = auctions.id ".
                                "WHERE auctions.status = 0 AND auctions.id = $id ".
                                "AND bidding.latestBid = (SELECT MAX(b.latestBid) from bidding b where b.auctionID = $id)")[0]; 
                                
                                    
            
            //return response()->json(['data' => $wonBids]);
        //}

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token= ['evId_uzFSsaMdlJxOElhxL:APA91bG2Y3o2zEKn34TfAddWCAqX-650FcdUmEwiIFJnxCAra65trOtJ9Ha_eeGfFqhBNCoJC2VqzGoiXTWcQY4gNIBAiA4IYhE5O52U-61HR-hZQ1mEEjTU8lPjEfQT9C1kga7e2KyT','cNG4rAdsSTSt0CaatB1hhr:APA91bGcbe3GIQF91BZxQiKWvbS_kYrUmE6ohO5NihvQzNpXXg_v-ebUofwdWYvMSFxkTLCStb097lTz4HhtyRuaNUP61YRlu8r2MuhCUrdF1NS4qAsBxovmQsIYI2wMjaSGme3J0Rr2'];

        // "Your are about to place a bid of AED --payment1-- on this --Make-- --Model-- --Year-- --(ExactModel)--
        
        // By clicking Confirm you agree to the Terms & Conditions and Privacy Policy .  
        
        // Note: If your payment arrives by --time--,we will charge the lowest applicable 
        // VAT rate for this car and and your total incl. VAT and Added Services will 
        // approximately be AED -- payment2-- ,(indication based on historical values)
        // .If your payment arrives late,we will have to charge you VAT on the vehicle 
        // and your total will be --payment3--AED incl.VAT and update Added Services."
        
        $notification = [
            'title' => 'Congratulations',
            "body" => "You have won a car: \n Model: $all_data->Model \n Make: $all_data->Make \n Year: $all_data->Year \n Your Bid: $all_data->latestBid ",
            'sound' => true,
        ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'1'];

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
