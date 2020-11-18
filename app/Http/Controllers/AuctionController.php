<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Images;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\newauctionEvent;


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
