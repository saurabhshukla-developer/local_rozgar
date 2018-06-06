<?php

namespace App\Http\Controllers;

use App\WorkType;
use App\User;
use App\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WorkTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $worktypes = DB::select('select * from work_type');
        $id = Auth::user()->id;
        $user_place = UserPlace::where('usersid', $id)->first();
        return view('WorkTypes.index', ['worktypes' => $worktypes, 'user_place' => $user_place]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('WorkTypes.create');
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
            'worktype' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $worktype = WorkType::create([
            'worktype' => $request->input('worktype')
        ]);

        if($worktype)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Worktype added successfully!');
            return redirect('home');
                // return redirect() -> route('home');
            }
        else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Worktype could not be added!');
                return redirect('home');
        }
        //return back() -> withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkType  $workType
     * @return \Illuminate\Http\Response
     */
    public function show(WorkType $workType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkType  $workType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worktype = WorkType::where('id', $id)->first();
        return view('WorkTypes.edit', ['worktype' => $worktype]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkType  $workType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'worktype' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $worktypeupdate = WorkType::where('id', $id)->update([
            'worktype' => $request->input('worktype')
        ]);

        if($worktypeupdate)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Worktype updated successfully!');
            return redirect('home');
                // return redirect() -> route('home');
            }
        else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Worktype could not be updated!');
                return redirect('home');
        }
        //return back() -> withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkType  $workType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo "in destroy";
        //echo $id;
        $worktype = WorkType::where('id', $id)->first();
        if($worktype->delete()){
            return redirect() -> route('home');
        }
        return back() -> withInput();
    }
}
