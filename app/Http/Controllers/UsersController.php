<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $users = User::all();
        //$users = DB::select("SELECT users.*, (SELECT userDeviceID FROM bidding where userID = users.id order by bidding.id desc Limit 1) as fcm_token FROM users");
        //return $users;
        return view('users.index',['users' => $users]);
    }

    public function approveUser($id, $startLimit, $endLimit)
    {
        $result = User::where('id', $id)->update(['approved' => 1, 'startLimit' => $startLimit, 'endLimit' => $endLimit]);
        if($result > 0){
            return back()->with('success','User approved successfully.');
        }
        else{
            return back()->with('success','No record updated.');
        }
    }

    public function disApproveUser($id)
    {
        $result = User::where('id', $id)->update(['approved' => 0]);
        if($result > 0){
            return back()->with('success','User unapproved successfully.');
        }
        else{
            return back()->with('success','No record updated.');
        }
    }
    public function deleteUser($id)
    {
        $result = User::where('id', $id)->delete();
        if($result > 0){
            return back()->with('success','User deleted successfully.');
        }
        else{
            return back()->with('success','No record updated.');
        }
    }
    
}
