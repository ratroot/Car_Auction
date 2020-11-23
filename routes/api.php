<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'Auth\RegisterController@APIregister');
Route::post('authenticate', 'Auth\LoginController@APIauthenticate');
Route::post('logout', 'Auth\LoginController@APIlogout');

//bidding
Route::post('postBid', 'API\BiddingController@postBid');
Route::get('getBids', 'API\BiddingController@getBids');
Route::get('getBid', 'API\BiddingController@getBidOnAuction');
Route::get('getAuction', 'API\AuctionAPI@getAuction');
Route::get('getUserPreviousBids', 'API\BiddingController@getUserPreviousBids');
Route::get('getUserLiveBids', 'API\BiddingController@getUserLiveBids');

//auctions
Route::get('purchased', 'API\AuctionAPI@purchased');
Route::get('auction', 'API\AuctionAPI@index');
Route::get('wonbids', 'API\AuctionAPI@wonbids');

