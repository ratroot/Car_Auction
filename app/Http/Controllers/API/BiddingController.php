<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Bidding;
use App\Events\testEvent;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class BiddingController extends Controller
{
    public function postBid(Request $request)
    {
        $auctionID = $request['Auction_id'];
        $userID = $request['User_id'];
        $latestBid = $request['Latestbid'];
        $userDeviceID = $request['Usertoken'];
        
        $bid = new Bidding;
        $bid->auctionID = $auctionID;
        $bid->userID = $userID;
        $bid->latestBid = $latestBid;
        $bid->userDeviceID = $userDeviceID;

        $bid->save();

        broadcast(new testEvent($bid));
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

    public function getBids(){

        return Bidding::all();
    }
}
