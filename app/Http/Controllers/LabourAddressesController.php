<?php

namespace App\Http\Controllers;

use App\LabourAddress;
use Illuminate\Http\Request;

class LabourAddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "yeah! u r there";
        $address = LabourAddress::create([
            'labourid' => $request->input('id'),
            'stateid' => $request->input('state'),
            'cityid' => $request->input('city'),
            'areaid' => $request->input('area'),
            'pincode' => $request->input('pincode')
        ]);
        if($address){
            return redirect() -> route('LabourDetails.show', $labour->id);
        }

        return back() -> withInput() -> with('error', 'Labour could not be registered!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LabourAddress  $labourAddress
     * @return \Illuminate\Http\Response
     */
    public function show(LabourAddress $labourAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LabourAddress  $labourAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(LabourAddress $labourAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LabourAddress  $labourAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LabourAddress $labourAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabourAddress  $labourAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabourAddress $labourAddress)
    {
        //
    }
}
