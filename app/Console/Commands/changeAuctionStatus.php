<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Auction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NotificationController;

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
        // $get_ids = DB::table('auctions')->select('id')->where('status','=','1')->where('EndDate','<',Carbon::now())->get();
        
        $updated = DB::table('auctions')->where('EndDate','<',Carbon::now())
                                        ->where(function($query){
                                            $query->where('status','=',1)
                                                   ->orWhere('status','=',3);
                                        })->update(['status'=> 0]);
        //$updated = DB::raw('UPDATE auctions SET status = 0 WHERE EndDate < "'.Carbon::now().'" AND (status = 1 OR status = 3)');
        //echo $updated;
        // $controller = new NotificationController();
        // $controller->notification();

        // foreach($get_ids as $item ){
        //     //$item->update(['status'=> 1]);
        //     echo $item->id;
        // }
        
    }
}
