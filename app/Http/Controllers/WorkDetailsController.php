<?php

namespace App\Http\Controllers;

use App\WorkDetail;
use App\WorkAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WorkDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areaid = $request->input('area');
        $worksa = DB::select('SELECT work_details.id, work_details.generatedid, work_details.fname, 
        work_details.mname, work_details.lname, work_details.contact, work_details.worktypeid, 
        work_details.description, work_details.startdate, work_details.enddate, work_details.deletedate, 
        work_details.hours, work_details.paymentperhour, work_details.flag,
        work_address.hno, work_address.locality, work_address.stateid, work_address.cityid, 
        work_address.areaid, work_address.pincode, work_type.worktype, state.statename, city.cityname, area.areaname 
        FROM (((((work_details INNER JOIN work_address ON work_details.id = work_address.workid) 
        inner join work_type on work_details.worktypeid=work_type.id) 
        inner join state on state.id=work_address.stateid) 
        inner join city on city.id=work_address.cityid)
        inner join area on area.id=work_address.areaid) where work_address.areaid = ? 
                  and work_details.flag=1', [$areaid]);
        $worksn = DB::select('SELECT work_details.id, work_details.generatedid, work_details.fname, 
        work_details.mname, work_details.lname, work_details.contact, work_details.worktypeid, 
        work_details.description, work_details.startdate, work_details.enddate, work_details.deletedate, 
        work_details.hours, work_details.paymentperhour, work_details.flag,
        work_address.hno, work_address.locality, work_address.stateid, work_address.cityid, 
        work_address.areaid, work_address.pincode, work_type.worktype, state.statename, city.cityname, area.areaname 
        FROM (((((work_details INNER JOIN work_address ON work_details.id = work_address.workid) 
        inner join work_type on work_details.worktypeid=work_type.id) 
        inner join state on state.id=work_address.stateid) 
        inner join city on city.id=work_address.cityid)
        inner join area on area.id=work_address.areaid) where work_address.areaid = ?
                  and work_details.flag=0', [$areaid]);
        
        $workcounta = DB::select('Select count(work_details.id) as workcounta from work_details,
                      work_address where work_address.areaid = ? and work_details.flag = 1', [$areaid]);

        $workcountn = DB::select('Select count(work_details.id) as workcountn from work_details,
        work_address where work_address.areaid = ? and work_details.flag = 0', [$areaid]);

        //print_r($workcounta);
        return view('WorkDetails.index', ['worksa' => $worksa, 'worksn' => $worksn, 
                                          'workcounta' => $workcounta, 'workcountn' => $workcountn]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = DB::select('select * from state order by statename');
        $worktype = DB::select('select * from work_type order by worktype');
        return view('WorkDetails.create', ['states' => $states], ['worktype' => $worktype]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo "in store";
       

        $validatedData = $request->validate([
            'fname' => 'required|alpha',
            'mname' => 'nullable|alpha',
            'lname' => 'nullable|alpha',
            'contact' => 'required|digits:10|numeric',
            'startdate' => 'required|date_format:Y-m-d|after_or_equal:today',
            'enddate' => 'nullable|date_format:Y-m-d|after_or_equal:startdate',
            'deletedate' => 'required|date_format:Y-m-d|after:startdate',
            'hours' => 'nullable|numeric|max:15',
            'paymentperhour' => 'nullable|numeric',
            'hno' => 'required|alpha_dash',
            'locality' => 'required',
            'pincode' => 'required|digits:6|numeric',
        ]);

        $pool = '0123456789abcdefABCDEF';
        $id = substr(str_shuffle(str_repeat($pool, 8)), 0, 8);

        //echo $id;
        $work = WorkDetail::create([
            'generatedid' => $id,
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'contact' => $request->input('contact'),
            'worktypeid' => $request->input('worktypeid'),
            'description' => $request->input('description'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
            'deletedate' => $request->input('deletedate'),
            'hours' => $request->input('hours'),
            'paymentperhour' => $request->input('paymentperhour')
        ]);
        if($work){

            $id = $work->id;
            $hno = $request->input('hno');
            $locality = $request->input('locality');
            $state = $request->input('state');
            $city = $request->input('city');
            $area = $request->input('area');
            $pincode = $request->input('pincode');
            DB::insert("insert into work_address(workid, hno, locality, stateid, cityid, areaid, pincode) values ($id, '$hno', '$locality', $state, $city, $area, $pincode)");
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'work registered successfully!');
            if (Auth::check()) {
                return redirect('home');
            }
            else{
                return redirect('welcome');
            }
            //return view('welcome') -> with('success', 'Work registered successfully!');
        }
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'work could not be registered!');
            return redirect('WorkDetails/create');
        }
        /*else{
            return back() -> withInput() -> with('error', 'Work could not be registered!');
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkDetail  $workDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //echo $id;
        $works = DB::select('SELECT work_details.id, work_details.generatedid, work_details.fname, 
        work_details.mname, work_details.lname, work_details.contact, work_details.worktypeid, 
        work_details.description, work_details.startdate, work_details.enddate, work_details.deletedate, 
        work_details.hours, work_details.paymentperhour, work_details.flag,
        work_address.hno, work_address.locality, work_address.stateid, work_address.cityid, 
        work_address.areaid, work_address.pincode, work_type.worktype, state.statename, city.cityname, area.areaname 
        FROM (((((work_details INNER JOIN work_address ON work_details.id = work_address.workid) 
        inner join work_type on work_details.worktypeid=work_type.id) 
        inner join state on state.id=work_address.stateid) 
        inner join city on city.id=work_address.cityid)
        inner join area on area.id=work_address.areaid) where work_details.id = ?', [$id]);

        //dd($works);
        return view('WorkDetails.show', ['works' => $works]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkDetail  $workDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //echo "in edit of workdetails";
        //echo $id;
        $states = DB::select('select * from state order by statename');
        $worktype = DB::select('select * from work_type order by worktype');
        $works = DB::select('select * from work_details inner join work_address on work_details.id=work_address.workid where work_details.id=?',[$id]);
        return view('WorkDetails.edit',['works' => $works, 'states' => $states, 'worktype' => $worktype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkDetail  $workDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fname' => 'required|alpha',
            'mname' => 'nullable|alpha',
            'lname' => 'nullable|alpha',
            'contact' => 'required|digits:10|numeric',
            'startdate' => 'required|date_format:Y-m-d',
            'enddate' => 'nullable|date_format:Y-m-d|after_or_equal:startdate',
            'deletedate' => 'required|date_format:Y-m-d|after:startdate',
            'hours' => 'nullable|numeric|max:15',
            'paymentperhour' => 'nullable|numeric',
            'hno' => 'required|alpha_dash',
            'locality' => 'required',
            'pincode' => 'required|digits:6|numeric',
        ]);

        $workupdate = WorkDetail::where('id', $id)->update([
            'generatedid' => $id,
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'contact' => $request->input('contact'),
            'worktypeid' => $request->input('worktypeid'),
            'description' => $request->input('description'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
            'deletedate' => $request->input('deletedate'),
            'hours' => $request->input('hours'),
            'paymentperhour' => $request->input('paymentperhour'),
            'flag' => $request->input('flag')
        ]);

        $addressupdate = WorkAddress::where('workid', $id)->update([
            'pincode' => $request->input('pincode'),
            'hno' => $request->input('hno'),
            'locality' => $request->input('locality')
        ]);

        if($workupdate && $addressupdate)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Work updated successfully!');
            if (Auth::check()) {
                return redirect('home');
            }
            else{
                return redirect('welcome');
            }
        }
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Work could not be registered!');
            return redirect('/work/selectarea');
        }
        //return back() -> withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkDetail  $workDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work = WorkDetail::where('id', $id)->first();
        $address = WorkAddress::where('workid', $id)->first();
        if($work->delete() && $address->delete()){
            return redirect() -> route('workselect');
        }
        return back() -> withInput();
    }

    public function selectarea()
    {
        //echo "in selectarea";
        $states = DB::select('select * from state order by statename');
        return view('WorkDetails.selectarea', ['states' => $states]);
    }
}
