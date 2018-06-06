<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserPlace;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
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
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'contact' => 'required|digits:10|numeric',
            'pincode' => 'required|digits:6|numeric',
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
        $user = User::create([
            'fname' => $data['fname'],
            'mname' => $data['mname'],
            'lname' => $data['lname'],
            'contact' => $data['contact'],
            
            'usertypeid' => $data['usertypeid'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        if($user){
            $userplace = UserPlace::create([
                'usersid' => $user->id,
                'stateid' => $data['state'],
                'cityid' => $data['city'],
                'areaid' => $data['area'],
                'pincode' => $data['pincode']
        ]);
        /*$data->session()->flash('message.level', 'success');
        $data->session()->flash('message.content', 'User registered successfully!');*/
        return redirect('home');
        }
        /*else{
            $data->session()->flash('message.level', 'danger');
            $data->session()->flash('message.content', 'User could not be registered!');
            return redirect('home');
        }*/
        else{
            return back() -> withInput();
        }
    }
}
