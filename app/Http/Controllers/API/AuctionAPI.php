<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Auction;
use App\Images;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuctionAPI extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        //return Carbon::now();
        $userID = $request['userID'];
        if($userID == null || $userID == 0 ){
            return response()->json('user id is required');
        }

        $response = array('data' => '');
        // $all_data = DB::table('auctions')
        //                 ->select()
        //                 ->where('status','=',1)
        //                 ->OrWhere('status','=',3)->get();

        $all_data = DB::select("SELECT a.id, a.Make, a.Model, a.ExactModel, a.Year, a.ReserveCost,a.status, a.StartDate, a.customer_price, ".
                    "a.EndDate, (SELECT path from images where images.auctionID = a.id LIMIT 1) as image FROM auctions a ".
                    "WHERE a.EndDate > '".Carbon::now()."' AND (a.status = 1 OR a.status = 3)");   
        foreach($all_data as $data){
            //$data->images = Images::where('auctionID', $data->id)->get('path');
            $data->highestBid =  DB::table('bidding')->where('bidding.auctionID', '=',$data->id)->max('latestBid');
            
            $currentBid =  DB::table('bidding')->where('bidding.auctionID', '=', $data->id)
                            ->select('latestBid')
                            ->where('bidding.userID', '=', $userID)
                            ->orderByDesc('bidding.id')
                            ->limit(1)
                            ->get('latestBid');

            if($data->status == 3){
                $data->negotiated = true;
            }
            else{
                $data->negotiated = false;
            }

            if(count($currentBid) > 0){
                $data->currentBid = $currentBid[0]->latestBid;
            }
            else{
                $data->currentBid = null;
            }
        }

        return response()->json(['data' => $all_data]);
    }

    public function getAuction(Request $request){
        $userID = $request['userID'];
        $auctionID = $request['auctionID'];

        $response = array('data' => '');
        $all_data = DB::table('auctions')->where('auctions.id','=',$auctionID)
                            ->leftJoin('auctions_other_info', 'auctions.id', '=', 'auctions_other_info.auctionID')
                            ->leftJoin('auctions_extra_info', 'auctions.id', '=', 'auctions_extra_info.auctionID')
                            ->get();


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

        $purchased = DB::select("SELECT p.userID, p.auctionID, p.auctionPrice, p.auctionPriceAndTax, a.Make, a.Model, a.Year, a.OdoMeterReading, (SELECT path from images where images.auctionID = p.auctionID LIMIT 1) as image FROM purchased p ".
                                "LEFT JOIN auctions as a on p.auctionID = a.id ".
                                "WHERE p.userID = $userID");   


        return response()->json(['data' => $purchased]);
    }
    
    public function wonbids(Request $request){
        $userID = $request['userID'];
        if($userID == null || $userID == 0 ){
            return response()->json('user id is required');
        }

        $wonBids =  DB::select("SELECT bidding.latestBid, auctions.id as auctionID, auctions.Make, auctions.Model, auctions.Year, invoice.status as invoice_status, (SELECT path from images where images.auctionID = auctions.id LIMIT 1) as image ".
                                "FROM bidding ".
                                "LEFT JOIN auctions on bidding.auctionID = auctions.id ".
                                "LEFT JOIN invoice on bidding.auctionID = invoice.auctionID ".
                                "WHERE auctions.status = 0 AND bidding.userID = $userID ".
                                "AND bidding.latestBid = (SELECT MAX(b.latestBid) from bidding b where b.auctionID = auctions.id and b.userID = $userID)");  
        
        return response()->json(['data' => $wonBids]);

    }
}
