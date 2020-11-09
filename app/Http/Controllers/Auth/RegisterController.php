<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function APIregister(Request $data)
    {
        $response = array('response' => '', 'status'=>false);
        $validator = Validator::make($data->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'EIDnumber' => ['required', 'string'],
            'DOB' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'EID_front_pic' => ['required', 'image','mimes:jpeg,png,jpg,gif,svg|max:3000'],
            'EID_back_pic' => ['required', 'image','mimes:jpeg,png,jpg,gif,svg|max:3000'],
        ]);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }else{
            
            $response['status'] = true;

            $profile_pic = $data->file('profile_pic');
            $profile_pic_name = '';
            $EID_front_pic = $data->file('EID_front_pic');
            $EID_front_pic_name = '';
            $EID_back_pic = $data->file('EID_back_pic');
            $EID_back_pic_name = '';

            if($EID_front_pic != null && $EID_back_pic !=null){
                $EID_front_pic_name= $EID_front_pic->getClientOriginalName();
                $EID_back_pic_name= $EID_back_pic->getClientOriginalName();
                $profile_pic_name= $EID_back_pic->getClientOriginalName();

                $EID_front_pic->move(public_path().'/image/',$EID_front_pic_name);
                $EID_back_pic->move(public_path().'/image/',$EID_back_pic_name);
                $profile_pic->move(public_path().'/image/',$profile_pic_name);
            }
            if($profile_pic != null){        
                $profile_pic_name= $EID_back_pic->getClientOriginalName();

                $profile_pic->move(public_path().'/image/',$profile_pic_name);
            }  


            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'EIDnumber' => $data['EIDnumber'],
                'DOB' => $data['EIDnumber'],
                'phone' => $data['phone'],
                'profile_pic' => $EID_back_pic_name,
                'EID_front_pic' => $EID_front_pic_name,
                'EID_back_pic' => $EID_back_pic_name,
            ]);
            $user->APIgenerateToken();
        
            $response['response'] = $user;
        }
        return $response;

    }
}
