<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchased extends Model
{
    protected $table = 'purchased';
    protected $guarded = [];
    public $timestamps = false;
}
