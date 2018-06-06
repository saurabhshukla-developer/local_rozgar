<?php

namespace App\Http\Controllers;

use App\LabourDetail;
use App\LabourAddress;
use App\LabourType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LabourDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areaid = $request->input('area');
        $stateid = $request->input('state');
        $cityid = $request->input('city');
        $typeid = $request->input('labourtype');
        $laboursa = DB::select('SELECT labour_details.id, labour_details.adhar, labour_details.fname, 
                    labour_details.mname, labour_details.lname, labour_details.contact, labour_details.age, labour_details.gender, labour_details.labourtypeid, 
                    labour_details.flag, labour_address.stateid, labour_address.cityid, labour_address.areaid, labour_address.pincode 
                    FROM labour_details  INNER JOIN labour_address ON labour_details.id = labour_address.labourid 
                    where labour_address.areaid = ? and labour_details.labourtypeid = ? and labour_details.flag=1 ' ,[$areaid, $typeid]);
        
        $labourcountat = DB::select('SELECT count(labour_details.id) as labourcountat from labour_details 
                    inner join labour_address on labour_details.id = labour_address.labourid
                    where labour_address.areaid = ? and labour_details.labourtypeid = ? and 
                    labour_details.flag = 1',[$areaid, $typeid]);

        $labourcounta = DB::select('SELECT count(labour_details.id) as labourcounta from labour_details 
                     inner join labour_address on labour_details.id = labour_address.labourid
                     where labour_address.areaid = ? and labour_details.flag = 1',[$areaid]);

        $labourcountas = DB::select('SELECT count(labour_details.id) as labourcountas from labour_details 
                    inner join labour_address on labour_details.id = labour_address.labourid
                    where labour_address.stateid = ? and labour_details.flag = 1',[$stateid]);

        $labourcountast = DB::select('SELECT count(labour_details.id) as labourcountast from labour_details 
                    inner join labour_address on labour_details.id = labour_address.labourid
                    where labour_address.stateid = ? and labour_details.labourtypeid = ? and
                    labour_details.flag = 1',[$stateid, $typeid]);
                    
        $labourcountac = DB::select('SELECT count(labour_details.id) as labourcountac from labour_details 
                    inner join labour_address on labour_details.id = labour_address.labourid
                    where labour_address.cityid = ? and labour_details.flag = 1',[$cityid]);
                    
        $labourcountact = DB::select('SELECT count(labour_details.id) as labourcountact from labour_details 
                    inner join labour_address on labour_details.id = labour_address.labourid
                    where labour_address.cityid = ? and labour_details.labourtypeid = ? and
                    labour_details.flag = 1',[$cityid, $typeid]);
                    
        $laboursn = DB::select('SELECT labour_details.id, labour_details.adhar, labour_details.fname, labour_details.mname, labour_details.lname, 
                    labour_details.contact, labour_details.age, labour_details.gender, labour_details.labourtypeid, labour_details.flag, 
                    labour_address.stateid, labour_address.cityid, labour_address.areaid, labour_address.pincode  
                    FROM labour_details  INNER JOIN labour_address ON labour_details.id = labour_address.labourid 
                    where labour_address.areaid = ? and labour_details.labourtypeid = ? and labour_details.flag=0' ,[$areaid, $typeid]);
       
        $labourcountn = DB::select('SELECT count(labour_details.id) as labourcountn from labour_details 
                inner join labour_address on labour_details.id = labour_address.labourid
                where labour_address.areaid = ? and labour_details.labourtypeid = ? and 
                labour_details.flag = 0',[$areaid, $typeid]);
            
        return view('LabourDetails.index', ['laboursa' => $laboursa, 'laboursn' => $laboursn, 
        'labourcountat' => $labourcountat, 'labourcountn' => $labourcountn, 
        'labourcountas' => $labourcountas, 'labourcountast' => $labourcountast,
        'labourcountac' => $labourcountac, 'labourcountact' => $labourcountact]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //echo "hey";
        $states = DB::select('select * from state order by statename');
        $labourtype = DB::select('select * from labour_type');
        return view('LabourDetails.create', ['states' => $states], ['labourtype' => $labourtype]);
        //return view('LabourDetails.create');
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
            'adhar' => 'required|digits:12|numeric|unique:labour_details,adhar',
            'fname' => 'required|alpha',
            'mname' => 'nullable|alpha',
            'lname' => 'nullable|alpha',
            'contact' => 'required|digits:10|numeric',
            'age' => 'required|numeric|min:18|max:80',
            'pincode' => 'required|digits:6|numeric',
        ]);

        $labour = LabourDetail::create([
            'labourtypeid' => $request->input('labourtype'),
            'adhar' => $request->input('adhar'),
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'contact' => $request->input('contact'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender')
        ]);
        if($labour){

            $id = $labour->id;
            $state = $request->input('state');
            $city = $request->input('city');
            $area = $request->input('area');
            $pincode = $request->input('pincode');
            DB::insert("insert into labour_address(labourid, stateid, cityid, areaid, pincode) values ($id, $state, $city, $area, $pincode)");
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'labour registered successfully!');
            if (Auth::check()) {
                return redirect('home');
            }
            else{
                return redirect('welcome');
            }
            //return redirect() -> route('home');
        }
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'labour could not be registered!');
            return redirect('LabourDetails/create');
        }
        //return back() -> withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LabourDetail  $labourDetail
     * @return \Illuminate\Http\Response
     */
    public function show(LabourDetail $labourDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LabourDetail  $labourDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //echo "in edit of labourdetails";
        //echo $id;
        $states = DB::select('select * from state order by statename');
        $labourtypes = DB::select('select * from labour_type order by labourtype');
        $labours = DB::select('SELECT labour_details.id, labour_details.adhar, labour_details.fname, 
                labour_details.mname, labour_details.lname, labour_details.contact, labour_details.age, 
                labour_details.gender, labour_details.labourtypeid, labour_details.flag, labour_address.stateid, 
                labour_address.cityid, labour_address.areaid, labour_address.pincode from labour_details 
                INNER JOIN labour_address on labour_details.id=labour_address.labourid where labour_details.id=?',[$id]);
        return view('LabourDetails.edit',['labours' => $labours, 'states' => $states, 'labourtypes' => $labourtypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LabourDetail  $labourDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo "in update of labour";
        $validatedData = $request->validate([
            'adhar' => 'required|digits:12|numeric',
            'fname' => 'required|alpha',
            'mname' => 'nullable|alpha',
            'lname' => 'nullable|alpha',
            'contact' => 'required|digits:10|numeric',
            'age' => 'required|numeric|min:18|max:80',
            'pincode' => 'required|digits:6|numeric',
        ]);

        $labourupdate = LabourDetail::where('id', $id)->update([
            'labourtypeid' => $request->input('labourtype'),
            'adhar' => $request->input('adhar'),
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'contact' => $request->input('contact'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'flag' => $request->input('flag')
        ]);

        $addressupdate = LabourAddress::where('labourid', $id)->update([
            'pincode' => $request->input('pincode')
        ]);

        if($labourupdate && $addressupdate)
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Labour updated successfully!');
            if (Auth::check()) {
                return redirect('home');
            }
            else{
                return redirect('welcome');
            }
        }
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Labour could not be updated!');
            return redirect('/labour/selectarea');
        }
        //return back() -> withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabourDetail  $labourDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $labour = LabourDetail::where('id', $id)->first();
        $address = LabourAddress::where('labourid', $id)->first();
        if($labour->delete() && $address->delete()){
            return redirect() -> route('labourselect');
        }
        return back() -> withInput();
    }

    public function selectarea()
    {
        //echo "in selectarea";
        $states = DB::select('select * from state order by statename');
        $labourtypes = DB::select('select * from labour_type order by labourtype');
        return view('LabourDetails.selectarea', ['states' => $states], ['labourtypes' => $labourtypes]);
    }
}
