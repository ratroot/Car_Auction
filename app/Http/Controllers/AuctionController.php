<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Images;
use App\Invoice;
use App\Auction_Other_Info;
use App\Auction_Extra_Info;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\newauctionEvent;
use Illuminate\Support\Facades\DB;
use App\Purchased;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
        // if(Auth::user()->approved == 0){
             return view('auctions.create');
        // }
        // else{
        //     Auth::logout();
        //     return redirect('/login');
        // }

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
        $request['StartDate'] = Carbon::parse($start)->addMinutes($request->timezoneoffset)->format('Y-m-d H:i:s');


        $end = date('Y-m-d H:i:s', strtotime($request->EndDate));
        //$request['EndDate'] = Carbon::parse($end,'Asia/Karachi')->tz('UTC')->format('Y-m-d H:i:s');
        $request['EndDate'] = Carbon::parse($end)->addMinutes($request->timezoneoffset)->format('Y-m-d H:i:s');

        //return $request['StartDate']." ".$request->EndDate;

        $timeStamp = now()->timestamp;

        $images = new Images;

        //$auction = new Auction;
        //$auction->save($request->all());
        

        //storing car body image
        if ($request->hasfile('carBodyImage')){
            $carimage = $request->file('carBodyImage');
            if($carimage != null){
                $name= Str::random(10).$carimage->getClientOriginalName();
                $carimage->move(public_path().'/image/',$name);
                $request['CarBodyImage'] = $name;
            }
            // foreach($request->file('carBodyImage') as $carimage){
            //     if($carimage != null){
            //         $name= $timeStamp.$carimage->getClientOriginalName();
            //         $carimage->move(public_path().'/image/',$name);
            //         $request['CarBodyImage'] = $name;
            //     }
                
            // }
        }
        //return $request;
        $auction = Auction::create($request->all());
        $auctionID = $auction->id;

        $all_images = array();

        if ($request->hasfile('filename')){
            foreach($request->file('filename') as $image){
                if($image != null){
                    $name= Str::random(10).$image->getClientOriginalName();
                    $image->move(public_path().'/image/',$name);
                    $data['path'] = $name;   
                    $data['auctionID'] = $auctionID;
                    Images::insert($data);
                    $all_images[] = ['path'=>$name];
                }
                
            }
        }
        
        $request['auctionID'] = $auctionID;
        $auction_other = Auction_Other_Info::create($request->all());

        $auction_extra = Auction_Extra_Info::create($request->all());

        $auction['images'] = $all_images;

        $pusher = array();

        $pusher['auctionID'] = $auctionID;
        $pusher['Make'] = $auction->Make;
        $pusher['Model'] = $auction->Model;
        $pusher['Year'] = $auction->Make;
        $pusher['ExactModel'] = $auction->ExactModel;
        $pusher['ReserveCost'] = $auction->ReserveCost;
        $pusher['status'] = 1;
        $pusher['StartDate'] = $auction->StartDate;
        $pusher['EndDate'] = $auction->EndDate;
        if(count($all_images) > 0){
            $pusher['image'] = $all_images[0]['path'];
        }
        else{
            $pusher['image'] = null;
        }

        //return $auction;
        broadcast(new newauctionEvent(json_encode($pusher)));

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
        $all_completed = DB::select("SELECT users.name,users.id, users.email, users.phone, a.latestBid, auctions.id as auctionID, auctions.Make, i.payment_proof, i.status as invoice_status, (SELECT userDeviceID FROM bidding where userID = users.id order by bidding.id desc Limit 1) as fcm_token ".
                                    "FROM `users` ".
                                    "LEFT JOIN bidding as a on a.userID = users.id ".
                                    "LEFT JOIN auctions on a.auctionID = auctions.id ".
                                    "LEFT JOIN invoice as i on a.auctionID = i.auctionID ".
                                    "WHERE auctions.status = 0 ".
                                    "AND a.latestBid = (SELECT MAX(b.latestBid) FROM bidding as b WHERE b.auctionID = auctions.id) ".
                                    "GROUP BY auctions.id, a.id, users.name, users.id,users.email, users.phone, a.latestBid, auctions.Make, i.payment_proof, i.status ".
                                    "ORDER BY a.id desc ");

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


    public function reauction($auctionID, $startdate, $enddate,$timezoneoffset)
    {
        $start = date('Y-m-d H:i:s', strtotime($startdate));
        //$startdate = Carbon::parse($start,'Asia/Karachi')->tz('UTC')->format('Y-m-d H:i:s');
        $startdate = Carbon::parse($start)->addMinutes($timezoneoffset)->format('Y-m-d H:i:s');

        $end = date('Y-m-d H:i:s', strtotime($enddate));
        //$enddate = Carbon::parse($end,'Asia/Karachi')->tz('UTC')->format('Y-m-d H:i:s');
        $enddate = Carbon::parse($end)->addMinutes($timezoneoffset)->format('Y-m-d H:i:s');


        Auction::where('id',$auctionID)->update(['status' => 3, 'StartDate'=>$startdate, 'EndDate'=>$enddate]);
        // $auction = Auction::where('id',$auctionID)->get();

        // $auction[0]->negotiated = true;
        // $image = Images::where('auctionID', $auctionID)->get('path');

        // $auction[0]->images = Images::where('auctionID', $auctionID)->get('path');

        $auction = DB::select("SELECT a.id as auctionID, a.Make, a.Model, a.ExactModel, a.Year, a.ReserveCost,a.status, a.StartDate, ".
                    "a.EndDate, (SELECT path from images where images.auctionID = a.id LIMIT 1) as image FROM auctions a ".
                    "WHERE a.id = $auctionID");  

        //$data = $auction[0];
        $pusher = array();

        

        if(count($auction) > 0){
            $pusher['auctionID'] = $auctionID;
            $pusher['Make'] = $auction[0]->Make;
            $pusher['Model'] = $auction[0]->Model;
            $pusher['Year'] = $auction[0]->Year;
            $pusher['ExactModel'] = $auction[0]->ExactModel;
            $pusher['ReserveCost'] = $auction[0]->ReserveCost;
            $pusher['status'] = 3;
            $pusher['StartDate'] = $auction[0]->StartDate;
            $pusher['EndDate'] = $auction[0]->EndDate;
            $pusher['negotiated'] = true;
            $pusher['image'] = $auction[0]->image;
        }
        
        //return $pusher;
        broadcast(new newauctionEvent(json_encode($pusher)));

        return back()->with('success','Record updated successfully');


    }

    public function approveInvoice($auctionID){

        $updated = Invoice::where('auctionID',$auctionID)->update(['status'=> 4]);
        if($updated > 0){
            return back()->with('success','Record updated successfully');

        }
        else{
            return back()->with('success','No record updated');

        }
    }

    public function disapproveInvoice($auctionID){

        $updated = Invoice::where('auctionID',$auctionID)->update(['status'=> 3]);

        if($updated > 0){
            return back()->with('success','Record updated successfully');

        }
        else{
            return back()->with('success','No record updated');

        }
    }

    public function changeinvoicestatus($auctionID, $value){

        $updated = Invoice::where('auctionID',$auctionID)->update(['status'=> $value]);

        if($updated > 0){
            return back()->with('success','Record updated successfully');
        }
        else{
            return back()->with('success','No record updated');

        }
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
