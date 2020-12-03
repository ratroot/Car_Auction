<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Auction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;


use App\Http\Controllers\API\InvoiceController;

class changeAuctionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:changeauctionstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command changes the status of auctions that are past the current date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $get_ids =  DB::table('auctions')->select('id')->where('EndDate','<',Carbon::now())
        //                                     ->where(function($query){
        //                                         $query->where('status','=',1)
        //                                             ->orWhere('status','=',3);
        //                                     })->get()->pluck('id');
        
        $updated = DB::table('auctions')->where('EndDate','<',Carbon::now())
                                        ->where(function($query){
                                            $query->where('status','=',1)
                                                   ->orWhere('status','=',3);
                                        })->update(['status'=> 0]);
        //Instantiate other controller class in this controller's method
        //echo $get_ids;
        //
        // $invoice = new InvoiceController;
        // //Use other controller's method in this controller's method
        // $request = new Request;
        // $request['ids'] = $get_ids;
        // $invoice->saveInvoiceData($request);
        
    }
}
