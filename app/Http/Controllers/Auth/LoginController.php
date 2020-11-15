<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *testing 123
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function APIauthenticate(Request $request)
    {
        $this->validateLogin($request);


        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            

            if($user->approved == 1){
                $user->APIgenerateToken();
                return response()->json([
                    'status' => true,
                    'data' => $user->toArray(),
                ]);
            }
            else{
                return response()->json([
                    'status' =>  false,
                    'data' => 'You are not approved yet, please contact admin.',
                ]);
            }
           
        }
        else{
            return response()->json(['status'=>false, 'data'=>'LOGIN FAILED']);
        }
    }

    public function APIlogout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
            return response()->json(['data' => 'User logged out.'], 200);

        }
        return response()->json(['data' => 'User not logged out.'], 200);
    }
}
