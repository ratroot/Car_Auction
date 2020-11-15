<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $users = User::all();
        return view('users.index',['users' => $users]);
    }

    public function approveUser($id)
    {
        $result = User::where('id', $id)->update(['approved' => 1]);
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
}
