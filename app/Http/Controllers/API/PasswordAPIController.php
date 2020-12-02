<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Invoice;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


use App\Mail\TestEmail;

class PasswordAPIController extends Controller
{
    public function resetPassword(Request $request){

        $email = trim($request["email"]);

        $exist = User::where('email',$email)->get();

        if(count($exist) > 0){
            $token = rand(100000,999999);
            User::where('email',$email)->update(['remember_token'=> $token]);
            Mail::to($email)->send(new TestEmail($token));
            if(count(Mail::failures()) > 0 ) {

                echo "There was one or more failures. They were: <br />";
             
                foreach(Mail::failures() as $email_address) {
                    echo " - $email_address <br />";
                 }
             }
             else{
                return response()->json(['data' => 'Email sent to you'], 200);

             }
        }
        else{
            return response()->json(['data' => 'No record exist against this email'], 403);
        }


    }

    public function resetPasswordToken(Request $request)
    {
        $response = array('response' => '', 'status'=>false);


        $remember_token = trim($request["remember_token"]);
        $password = trim($request["password"]);
        if($remember_token !=null || $remember_token != ""){

            $token = User::where('remember_token',$remember_token)->get();

            if(count($token) > 0){
                $validator = Validator::make($request->all(), [
                    'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'min:6',
                    'remember_token' => 'min:6'
                ]);

                if ($validator->fails()) {
                    $response['status'] = false;
                    $response['response'] = $validator->messages();
                }
                else{
                    $hash = Hash::make($password);
                    User::where('email',$token[0]->email)->update(["password"=>$hash]);
                    $response['status'] = true;
                    $response['response'] = "Password updated successfully";

                }
            }
            
            else{
                $response['status'] = false;
                $response['response'] = "You token is not matched or expired. Please try again";
            }
            return $response;

        }
       
    }
}
