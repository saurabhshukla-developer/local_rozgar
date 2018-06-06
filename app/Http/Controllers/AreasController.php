<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use App\State;
use App\User;
use App\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AreasController extends Controller
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
        $user_place = UserPlace::where('usersid', $id)->first();
        return view('Areas.index', ['states' => $states, 'user_place' => $user_place]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //echo "in area of cities";
        //return view('Areas.create', ['cityid' => $id]);
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
            'areaname' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $area = Area::create([
            'areaname' => $request->input('areaname'),
            'cityid' => $request->input('cityid')
        ]);

        if($area)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Area added successfully!');
            return redirect('home');
                // return redirect() -> route('home');
        }
        else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Area could not be added!');
                return redirect('home');//return redirect() -> route('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Areas.create', ['cityid' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //echo "in edit of area";
        $area = Area::where('id', $id)->first();
        return view('Areas.edit', ['area' => $area]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'areaname' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $areaupdate = Area::where('id', $id)->update([
            'areaname' => $request->input('areaname')
        ]);

        if($areaupdate)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Area updated successfully!');
            return redirect('home');
                // return redirect() -> route('home');
        }
        else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Area could not be updated!');
                return redirect('home');//return redirect() -> route('home');
        }
        //return back() -> withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::where('id', $id)->first();
        if($area->delete()){
            return redirect() -> route('home');
        }
        return back() -> withInput();
    }
}
