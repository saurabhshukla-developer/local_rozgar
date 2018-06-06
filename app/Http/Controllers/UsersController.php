<?php

namespace App\Http\Controllers;

use App\User;
use App\UserType;
use App\UserPlace;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //echo "in index of users";
        //$request->input('password'),
        //$id = Auth::user()->id;
        $id = $request->id;
        $validatedData = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $password = User::where('id', $id)->update([
            'password' => bcrypt($request['password'])
        ]);
        if($password){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Password updated successfully!');
            return redirect('home');
                // return redirect() -> route('home');
            }
        else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Password could not be updated!');
                return redirect('home');
        //return redirect() -> route('home');
        }
        /*else{
            return back() -> withInput();
        }*/

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //echo "in create of user";
        //echo $id;
        return view('Users.changepassword', ['id' => $id]);
        //$userdetails = UserPlace::where('usersid', $request->id)->first();
        //return response()->view($userdetails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo "in store of users";
        //echo $request->usertypeid;
        $usertypeid = $request->usertypeid;
        $stateid = $request->state;
        $cityid = $request->city;
        if($usertypeid <= 4){
            $users = DB::select('SELECT users.id, users.fname, users.lname, users.mname, users.email, users.contact,
            users.profile, users.usertypeid, user_place.stateid, user_place.cityid, user_place.areaid, 
            user_place.pincode, user_type.usertype, state.statename, city.cityname, area.areaname 
            FROM (((((users INNER JOIN user_place ON users.id = user_place.usersid) 
            inner join user_type on users.usertypeid=user_type.id) 
            inner join state on state.id=user_place.stateid) 
            inner join city on city.id=user_place.cityid)
            inner join area on area.id=user_place.areaid) where users.usertypeid=? order by state.statename',[$usertypeid]);
        }
        else if($usertypeid == 5){
            //cityhead
            $users =  DB::select('SELECT users.id, users.fname, users.lname, users.mname, users.email, users.contact,
            users.profile, users.usertypeid, user_place.stateid, user_place.cityid, user_place.areaid, 
            user_place.pincode, user_type.usertype, state.statename, city.cityname, area.areaname 
            FROM (((((users INNER JOIN user_place ON users.id = user_place.usersid) 
            inner join user_type on users.usertypeid=user_type.id) 
            inner join state on state.id=user_place.stateid) 
            inner join city on city.id=user_place.cityid)
            inner join area on area.id=user_place.areaid) 
            where users.usertypeid=? and user_place.stateid=? order by city.cityname',[$usertypeid, $stateid]);
        }
        else if($usertypeid == 6){
            //areahead
            $users = DB::select('SELECT users.id, users.fname, users.lname, users.mname, users.email, users.contact,
            users.profile, users.usertypeid, user_place.stateid, user_place.cityid, user_place.areaid, 
            user_place.pincode, user_type.usertype, state.statename, city.cityname, area.areaname 
            FROM (((((users INNER JOIN user_place ON users.id = user_place.usersid) 
            inner join user_type on users.usertypeid=user_type.id) 
            inner join state on state.id=user_place.stateid) 
            inner join city on city.id=user_place.cityid)
            inner join area on area.id=user_place.areaid) 
            where users.usertypeid=? and user_place.stateid=? and user_place.cityid=? order by area.areaname',[$usertypeid, $stateid, $cityid]);
        }
        else {
            echo 'choose a valid user';
        }
        return view('Users.index', ['users' => $users, 'usertypeids' => $usertypeid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //echo "show";
        $users = DB::select('SELECT users.id, users.fname, users.lname, users.mname, users.email, users.contact,
         users.profile, users.usertypeid, user_place.stateid, user_place.cityid, user_place.areaid, 
         user_place.pincode, user_type.usertype, state.statename, city.cityname, area.areaname 
         FROM (((((users INNER JOIN user_place ON users.id = user_place.usersid) 
         inner join user_type on users.usertypeid=user_type.id) 
         inner join state on state.id=user_place.stateid) 
         inner join city on city.id=user_place.cityid)
         inner join area on area.id=user_place.areaid) where users.id = ?', [$id]);
        
        //logged in user
        $id = Auth::user()->id;
        $user_place = UserPlace::where('usersid', $id)->first();

        return view('Users.show', ['users' => $users, 'user_place' => $user_place]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = DB::select('select * from state');
        $usertype = DB::select('select * from user_type');
        $users = DB::select('SELECT users.id, users.fname, users.lname, users.mname, users.email, users.contact,
         users.profile, users.usertypeid, user_place.stateid, user_place.cityid, user_place.areaid, 
         user_place.pincode, user_type.usertype, state.statename, city.cityname, area.areaname 
         FROM (((((users INNER JOIN user_place ON users.id = user_place.usersid) 
         inner join user_type on users.usertypeid=user_type.id) 
         inner join state on state.id=user_place.stateid) 
         inner join city on city.id=user_place.cityid)
         inner join area on area.id=user_place.areaid) where users.id = ?', [$id]);
        return view('Users.edit',['users' => $users, 'states' => $states, 'usertype' => $usertype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo "in update";
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'contact' => 'required|digits:10|numeric',
            'pincode' => 'required|digits:6|numeric',
        ]);

        $userupdate = User::where('id', $id)->update([
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'contact' => $request->input('contact'),
            'profile' => $request->input('profile'),
            'usertypeid' => $request->input('usertypeid')
        ]);

        $addressupdate = UserPlace::where('usersid', $id)->update([
            'pincode' => $request->input('pincode')
        ]);

        if($userupdate && $addressupdate)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'User updated successfully!');
            return redirect('home');
                // return redirect() -> route('home');
            }
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'User could not be updated!');
            return redirect('home');
        }
        //return back() -> withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $address = UserPlace::where('usersid', $id)->first();
        if($user->delete() && $address->delete()){
            return redirect() -> route('home');
        }
        return back() -> withInput();
    }

    public function selectrole()
    {
        //echo "in selectrole";
        $usertypes = UserType::all();
        $states = State::all();
        return view('Users.selectrole', ['usertypes' => $usertypes, 'states' => $states]);
    }
}
