<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Bidding;
use App\Events\testEvent;

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
        $bid->userID = $auctionID;
        $bid->latestBid = $auctionID;
        $bid->userDeviceID = $auctionID;

        $bid->save();

        broadcast(new testEvent($bid));
    }
}
