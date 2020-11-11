<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Auction;
use App\Images;
use App\Events\testEvent;

use Illuminate\Http\Request;

class BiddingController extends Controller
{
    public function postBid(Request $request)
    {
        $data = $request['Latestbid'];
        //return $data;
        broadcast(new testEvent($data));
    }
}
