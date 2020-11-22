<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased', function (Blueprint $table) {
            $table->id();
            //$table->integer('userID');
            //$table->integer('auctionID');
            $table->foreignId('userID')->constrained('users');
            $table->foreignId('auctionID')->constrained('auctions');
            $table->biginteger('auctionPrice');
            $table->biginteger('auctionPriceAndTax');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchased');

    }
}
