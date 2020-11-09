<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    protected $fillable = ['path','auctionID'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    } 
}
