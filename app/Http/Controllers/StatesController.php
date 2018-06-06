<?php

namespace App\Http\Controllers;

use App\State;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = DB::select('select * from state order by statename');
        return view('States.index', ['states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //echo "in create";
        return view('States.create');
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
            'statename' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $state = State::create([
            'statename' => $request->input('statename')
        ]);

        if($state)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'State added successfully!');
            return redirect('/States');
        }
        else
        {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'State could not be added!');
                return redirect('/States');
        }
        //return back() -> withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        dd($state);
        //$cities = DB::select('select * from city where stateid = :id', ['id' => $state]);
        //return view('LabourDetails.create', ['cities' => $cities]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::where('id', $id)->first();
        //dd($state);
        return view('States.edit', ['state' => $state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'statename' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $stateupdate = State::where('id', $id)->update([
            'statename' => $request->input('statename')
        ]);

        if($stateupdate)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'State updated successfully!');
            return redirect('/States');
        }
        else
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'State could not be updated!');
            return redirect('/States');
        }
        //return back() -> withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo "in destroy of state";
        //echo $id;
        $state = State::where('id', $id)->first();
        if($state->delete())
        {
            /*$request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'State deleted successfully!');
            return redirect('/States');*/
            return redirect() -> route('home');
        }
        /*else
        {
            $id->session()->flash('message.level', 'danger');
            $id->session()->flash('message.content', 'State could not be deleted!');
            return redirect('/States');
        }*/
        return back() -> withInput();
    }

    public function findcity(Request $request)
    {
        $data = DB::select('select * from city where stateid = :id order by cityname', ['id' => $request->id]);
        //dd($data);
        return response()->json($data);
    }

    public function findarea(Request $request)
    {
        $data = DB::select('select * from area where cityid = :id order by areaname', ['id' => $request->id]);
        return response()->json($data);
    }

    public function aboutus()
    {
        return view('States.aboutus');
    }
}
