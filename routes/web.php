<?php

use Illuminate\Support\Facades\Route;
use App\Events\testEvent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    //broadcast(new testEvent('some data'));

    return view('home');
});//->middleware('auth');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::get('/users', 'UsersController@index');
Route::get('/approve/{id}/{startLimit}/{endLimit}', 'UsersController@approveUser');
Route::get('/disapprove/{id}', 'UsersController@disApproveUser');
Route::get('/user/delete/{id}', 'UsersController@deleteUser');


//auction
Route::post('/auction/store', 'AuctionController@store');
Route::get('/completed', 'AuctionController@completed');
Route::get('/auction', 'AuctionController@index');
Route::get('/auction/create', 'AuctionController@create');
Route::get('/auction/purchased/{userID}/{auctionID}/{price}/{pricetax}', 'AuctionController@purchased');
Route::get('/auction/reauction/{auctionID}/{startdate}/{enddate}/{timezoneoffset}', 'AuctionController@reauction');

//demo
Route::get('/notification', 'NotificationController@notification');

//invoice
Route::get('/invoice/approve/{auctionID}', 'AuctionController@approveInvoice');
Route::get('/invoice/disapprove/{auctionID}', 'AuctionController@disapproveInvoice');
Route::get('/invoice/changestatus/{auctionID}/{value}', 'AuctionController@changeinvoicestatus');
