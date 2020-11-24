<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Images;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\newauctionEvent;
use Illuminate\Support\Facades\DB;
use App\Purchased;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $data = Auction::all();
        return view('auctions.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auctions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $start = date('Y-m-d H:i:s', strtotime($request->StartDate));
        $request['StartDate'] = Carbon::parse($start,'Asia/Karachi')->tz('UTC')->format('Y-m-d H:i:s');

        $end = date('Y-m-d H:i:s', strtotime($request->EndDate));
        $request['EndDate'] = Carbon::parse($end,'Asia/Karachi')->tz('UTC')->format('Y-m-d H:i:s');

        $images = new Images;

        //$auction = new Auction;
        //$auction->save($request->all());
        
        $auction = Auction::create($request->all());
        $auctionID = $auction->id;

        $all_images = array();
        $timeStamp = now()->timestamp;

        if ($request->hasfile('filename')){
            foreach($request->file('filename') as $image){
                if($image != null){
                    $name= $timeStamp.$image->getClientOriginalName();
                    $image->move(public_path().'/image/',$name);
                    $data['path'] = $name;   
                    $data['auctionID'] = $auctionID;
                    Images::insert($data);
                    $all_images[] = ['path'=>$name];
                }
                
            }
        }
         
        $auction['images'] = $all_images;

       // return response()->json($auction);
        broadcast(new newauctionEvent(json_encode($auction)));

        return back()->with('success','Form submitted successfully');
        //view('auctions.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        //
    }


    public function completed(){
        $all_completed = DB::select("SELECT users.name,users.id, a.latestBid, auctions.id as auctionID, auctions.Make ".
                                    "FROM `users` ".
                                    "LEFT JOIN bidding as a on a.userID = users.id ".
                                    "LEFT JOIN auctions on a.auctionID = auctions.id ".
                                    "WHERE auctions.status = 0 ".
                                    "AND a.latestBid = (SELECT MAX(b.latestBid) FROM bidding as b WHERE b.auctionID = auctions.id) ".
                                    "GROUP BY auctions.id, users.name, users.id, a.latestBid, auctions.Make");

        return view('auctions.completed',['data' => $all_completed]);
    }

    public function purchased($userID, $auctionID, $price, $pricetax){

        Auction::where('id',$auctionID)->update(['status' => 2]);
        $purchased = new Purchased;
        $purchased->userID = $userID;
        $purchased->auctionID = $auctionID;
        $purchased->auctionPrice = $price;
        $purchased->auctionPriceAndTax = $pricetax;
        $purchased->save();

        return back()->with('success','Record updated successfully');


    }


    public function reauction($auctionID, $startdate, $enddate)
    {
        $start = date('Y-m-d H:i:s', strtotime($startdate));
        $startdate = Carbon::parse($start,'Asia/Karachi')->tz('UTC')->format('Y-m-d H:i:s');

        $end = date('Y-m-d H:i:s', strtotime($enddate));
        $enddate = Carbon::parse($end,'Asia/Karachi')->tz('UTC')->format('Y-m-d H:i:s');

        $auction = Auction::where('id',$auctionID)->get();
        Auction::where('id',$auctionID)->update(['status' => 3, 'StartDate'=>$startdate, 'EndDate'=>$enddate]);
        $auction[0]->negotiated = true;
        // $purchased = new Purchased;
        // $purchased->userID = $userID;
        // $purchased->auctionID = $auctionID;
        // $purchased->auctionPrice = $price;
        // $purchased->auctionPriceAndTax = $pricetax;
        // $purchased->save();
         //return $auction;
        broadcast(new newauctionEvent(json_encode($auction)));

        return back()->with('success','Record updated successfully');


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auction $auction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        //
    }
}
