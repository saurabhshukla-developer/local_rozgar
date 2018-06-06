<?php

namespace App\Http\Controllers;

use App\LabourType;
use App\User;
use App\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LabourTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labourtypes = DB::select('select * from labour_type');
        $id = Auth::user()->id;
        $user_place = UserPlace::where('usersid', $id)->first();
        return view('LabourTypes.index', ['labourtypes' => $labourtypes, 'user_place' => $user_place]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('LabourTypes.create');
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
            'labourtype' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $labourtype = LabourType::create([
            'labourtype' => $request->input('labourtype')
        ]);

        if($labourtype)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Employee type added successfully!');
            return redirect('home');
                // return redirect() -> route('home');
        }
        else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Employee type could not be added!');
                return redirect('home');
            //return redirect() -> route('home');
        }
        return back() -> withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LabourType  $labourType
     * @return \Illuminate\Http\Response
     */
    public function show(LabourType $labourType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LabourType  $labourType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $labourtype = LabourType::where('id', $id)->first();
        return view('LabourTypes.edit', ['labourtype' => $labourtype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LabourType  $labourType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'labourtype' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $labourtypeupdate = LabourType::where('id', $id)->update([
            'labourtype' => $request->input('labourtype')
        ]);

        if($labourtypeupdate)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Employee type updated successfully!');
            return redirect('home');
            // return redirect() -> route('home');
        }
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Employee type could not be updated!');
            return redirect('home');
        }
        //return back() -> withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabourType  $labourType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $labourtype = LabourType::where('id', $id)->first();
        if($labourtype->delete()){
            return redirect() -> route('home');
        }
        return back() -> withInput();
    }
}
