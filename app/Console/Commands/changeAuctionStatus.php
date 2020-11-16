<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Auction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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
        $auctionUpdated = DB::table('auctions')->where('status','=','1')->where('EndDate','<',Carbon::now())->update(['status'=> 0]);

    }
}
