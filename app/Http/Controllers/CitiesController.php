<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use App\User;
use App\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = DB::select('select * from state');
        $id = Auth::user()->id;
        //echo $id;
        $user_place = UserPlace::where('usersid', $id)->first();
        //dd($user_place);
        return view('Cities.index', ['states' => $states, 'user_place' => $user_place]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //echo $id;
        //return view('Cities.create', ['stateid' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cityname' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $city = City::create([
            'cityname' => $request->input('cityname'),
            'stateid' => $request->input('stateid')
        ]);

        if($city)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'City added successfully!');
            return redirect('home');
            // return redirect() -> route('home');
        }
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'City could not be added!');
            return redirect('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Cities.create', ['stateid' => $id]);
        //$cities = DB::select('select * from city where stateid = :id', ['id' => $city]);
        //return view('LabourDetails.create', ['cities' => $cities]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //echo "in edit of city";
        $city = City::where('id', $id)->first();
        return view('Cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cityname' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $cityupdate = City::where('id', $id)->update([
            'cityname' => $request->input('cityname')
        ]);

        if($cityupdate)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'City updated successfully!');
            return redirect('home');
            // return redirect() -> route('home');
        }
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'City could not be updated!');
            return redirect('home');
        }
        //return back() -> withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo $id;
        //echo "in destroy of city";
        $city = City::where('id', $id)->first();
        if($city->delete()){
            return redirect() -> route('home');
        }
        return back() -> withInput();
    }
}
