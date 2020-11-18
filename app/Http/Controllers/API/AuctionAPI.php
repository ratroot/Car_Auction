<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Auction;
use App\Images;

use Illuminate\Http\Request;

class AuctionAPI extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function index()
    {
        $response = array('data' => '');
        $all_data = DB::table('auctions')->where('status','=',1)->get();

        foreach($all_data as $data){
            $data->images = Images::where('auctionID', $data->id)->get('path');
            $data->highestBid =  DB::table('bidding')->where('bidding.auctionID', '=',$data->id)->max('latestBid');
        }

        return response()->json(['data' => $all_data]);
    }
}
