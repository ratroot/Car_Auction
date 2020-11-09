<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testEventController extends Controller
{
    public function test($msg)
    {
        return $msg;
    }
}
