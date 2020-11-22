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

    public function getAuction(Request $request){
        $userID = $request['userID'];
        $auctionID = $request['auctionID'];

        $response = array('data' => '');
        $all_data = DB::table('auctions')->where('id','=',$auctionID)->get();

        foreach($all_data as $data){
            $data->images = Images::where('auctionID', $data->id)->get('path');
            $data->highestBid =  DB::table('bidding')->where('bidding.auctionID', '=',$data->id)->max('latestBid');
            $currentBid =  DB::table('bidding')->where('bidding.auctionID', '=', $auctionID)
                                                ->select('latestBid')
                                                ->where('bidding.userID', '=', $userID)
                                                ->orderByDesc('bidding.id')
                                                ->limit(1)
                                                ->get('latestBid');
            
            if(count($currentBid) > 0){
                $data->currentBid = $currentBid[0]->latestBid;
            }
            else{
                $data->currentBid = null;
            }
        }

        return response()->json(['data' => $all_data]);
    }

    public function purchased(Request $request){
        $userID = $request['userID'];
        if($userID == null || $userID == 0 ){
            return response()->json('user id is required');
        }

        $purchased = DB::table('auctions')->get();

        return response()->json(['data' => $purchased]);
    } 
}
