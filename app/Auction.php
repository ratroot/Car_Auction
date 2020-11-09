<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = 'auctions';
    protected $guarded = ['filename'];
    public $timestamps = false;

    // public function images()
    // {
    //     return $this->hasMany('App\Images');
    // } 
}
