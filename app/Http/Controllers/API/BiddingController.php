<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Bidding;
use App\Events\testEvent;
use App\Events\addSeconds;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Controllers\API\InvoiceController;


class BiddingController extends Controller
{
    public function postBid(Request $request)
    {
        $auctionID = $request['Auction_id'];
        $userID = $request['User_id'];
        $latestBid = $request['Latestbid'];
        $userDeviceID = $request['Usertoken'];
        $negotiated = $request['negotiated'];


        $bid = new Bidding;
        $bid->auctionID = $auctionID;
        $bid->userID = $userID;
        $bid->latestBid = $latestBid;
        $bid->userDeviceID = $userDeviceID;

        $bid->save();


        $myBid = 0;
        $myUserId = 0;

        //$highestBid = DB::table("bidding")->select('userID',DB::raw('MAX(latestBid) as latestBid'))->where('auctionID','=',$auctionID)->groupBy('userID')->limit(1)->get();
        $highestBid = DB::select("SELECT userID, auctionID, latestBid From bidding where latestBid = (Select MAX(latestBid) from bidding b where b.auctionID = $auctionID) AND auctionID = $auctionID LIMIT 1");

        //return $highestBid;

        foreach($highestBid as $item){
            $myUserId = $item->userID;
            $myBid = $item->latestBid;
        }

        //return $highestBid;
       // return $myUserId." ".$userID." ".$latestBid." ".$myBid;
        if($myUserId == $userID && $latestBid == $myBid){
            if($negotiated == true){
                $seconds= $request['seconds'];

                if($seconds == null || $seconds == ""){
                    $seconds = 0;
                }

                DB::statement("UPDATE auctions SET EndDate = DATE_ADD(EndDate, INTERVAL $seconds second) WHERE id = $auctionID");

                $pusher = array();
                $pusher['auctionID'] = $auctionID;
                $pusher['userID'] = $userID;
                $pusher['latestBid'] = $latestBid;
                $pusher['userDeviceID'] = $userDeviceID;
                $pusher['negotiated'] = true;
                $pusher['seconds'] = $seconds;

                broadcast(new addSeconds($pusher));

                return "true";
            }
            else{
                broadcast(new testEvent($bid));

                return "true";
            }
            
            
        }
        else{
           return "false";
        }
        //$highestBid = DB::table("bidding")->where('auctionID','=',$auctionID)->max('latestBid');

        // if($latestBid > $highestBid){
            
        //     $bid = new Bidding;
        //     $bid->auctionID = $auctionID;
        //     $bid->userID = $userID;
        //     $bid->latestBid = $latestBid;
        //     $bid->userDeviceID = $userDeviceID;
    
        //     $bid->save();
    
        //     broadcast(new testEvent($bid));

        //     return "true";
        // }
        // else{
        //     return "false";
        // }

        // $bid = new Bidding;
        // $bid->auctionID = $auctionID;
        // $bid->userID = $userID;
        // $bid->latestBid = $latestBid;
        // $bid->userDeviceID = $userDeviceID;

        // $bid->save();

        // broadcast(new testEvent($bid));
    }

    public function getBidOnAuction(Request $request){

        $auctionID = $request['Auction_id'];
        $userID = $request['User_id'];
        
        $data = DB::table('bidding')
                    ->select('bidding.id as biddingID', 'latestbid as currentBid')
                    ->where('bidding.auctionID', '=', $auctionID)
                    ->where('bidding.userID', '=', $userID)
                    ->orderByDesc('bidding.id')
                    ->limit(1)
                    ->get();
        if(count($data) > 0){
            $data[0]->highestBid =  DB::table('bidding')->where('bidding.auctionID', '=',$auctionID)->max('latestBid');   
            return response()->json(['data' => $data]);

        }
        else{
            $emp_data = array('biddingID'=>null,'currentBid'=>null);
            $emp_data['highestBid'] =  DB::table('bidding')->where('bidding.auctionID', '=',$auctionID)->max('latestBid');   
            return response()->json(['data' => [$emp_data]]);
        }


    }

    public function getUserPreviousBids(Request $request){
        $userID = $request['userID'];
        if($userID == null || $userID == 0){
            return response()->json('user id is required');
        }

        $bids = DB::select("SELECT bidding.latestBid, auctions.id as auctionID, auctions.Make, auctions.Model, auctions.Year, (SELECT path from images where images.auctionID = auctions.id LIMIT 1) as image ".
                            "FROM bidding ".
                            "LEFT JOIN auctions on bidding.auctionID = auctions.id ".
                            "WHERE auctions.status = 0 AND bidding.userID = $userID");
        return response()->json($bids);
    }
    public function getUserLiveBids(Request $request){
        $userID = $request['userID'];
        if($userID == null || $userID == 0){
            return response()->json('user id is required');
        }
        $bids = DB::select("SELECT bidding.latestBid, auctions.id as auctionID, auctions.Make, auctions.Model, auctions.Year, (SELECT path from images where images.auctionID = auctions.id LIMIT 1) as image ".
                            "FROM bidding ".
                            "LEFT JOIN auctions on bidding.auctionID = auctions.id ".
                            "WHERE (auctions.status = 1 OR auctions.status = 3) AND bidding.userID = $userID ".
                            "AND bidding.id = (SELECT b.id FROM bidding as b WHERE b.auctionID = auctions.id ORDER BY b.id DESC LIMIT 1) ".
                            "GROUP BY bidding.latestBid, auctions.id, auctions.Make, auctions.Model, auctions.Year, image");
        
        return response()->json($bids);
    }
    
    public function getBids(){

        return Bidding::all();
    }
}
