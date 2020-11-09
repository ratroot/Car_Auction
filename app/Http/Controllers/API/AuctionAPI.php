<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
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
        $all_data = Auction::all();
        foreach($all_data as $data){
            $data['images'] = Images::where('auctionID', $data->id)->get('path');; 
        }

        
        return response()->json(['data' => $all_data]);
    }
}
