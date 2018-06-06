<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserPlace;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        //$user = User::where('id',Auth::user()->id)->first();
        //$userplace = UserPlace::where('usersid',Auth::user()->id)->first();
        $users = DB::select('SELECT users.id, users.fname, users.lname, users.mname, users.email, users.contact,
         users.profile, users.usertypeid, user_place.stateid, user_place.cityid, user_place.areaid, 
         user_place.pincode, user_type.usertype, state.statename, city.cityname, area.areaname 
         FROM (((((users INNER JOIN user_place ON users.id = user_place.usersid) 
         inner join user_type on users.usertypeid=user_type.id) 
         inner join state on state.id=user_place.stateid) 
         inner join city on city.id=user_place.cityid)
         inner join area on area.id=user_place.areaid) where users.id = ?', [$id]);
        return view('home', ['users' => $users]);
    }
}
