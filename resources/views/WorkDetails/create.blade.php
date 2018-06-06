@extends('layouts.app')

@section('content')


@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content')!!}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container-fluid">
<h2 class="text-center animated fInUp">Register Your Work here</h2>
<div class="container">
        
                
    <form class="form" action="{{route('WorkDetails.store')}}" method="POST" style=" padding:40px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc; ">
    {{csrf_field()}}
        <div class="row">
        <div class="col-sm-4">
         <div class="form-group">
          <label>First Name</label>
            <input type="name" class="form-control" id="email" placeholder="Enter first name" name="fname">
         </div>
        </div>
        <div class="col-sm-4">
                <div class="form-group">
                 <label>Middle Name</label>
                   <input type="name" class="form-control" id="email" placeholder="Enter middle name" name="mname">
                </div>
               </div>
        <div class="col-sm-4">
             <div class="form-group">
              <label>Last Name</label>
                 <input type="name" class="form-control" id="email" placeholder="Enter last name" name="lname">
             </div>
         </div> 
        </div> 
        <div class="row">   
            <div class="col-sm-4">
              <div class="form-group">
                  <label>Contact No</label>
                  <input type="number" class="form-control" id="pwd" placeholder="Enter number" name="contact">
              </div>
        </div> 
        <div class="col-sm-4">
                    <div class="form-group">
                            <label for="pwd">Work Type</label>
                           <select class="form-control" name="worktypeid">
                           <option value="0" disabled="true" selected="true">Select Work Type</option>
                           @foreach($worktype as $work)
                            <option value="{{ $work->id }}">{{ $work->worktype }}</option>
                           @endforeach 
                           </select>
                        </div>
            </div>
        <div class="col-sm-4">
                <div class="form-group">
                        <label for="pwd">Work Description</label>
                       <input type="text" class="form-control" id="pwd" placeholder="Enter Description" name="description">
                   </div>
        </div>
    
    </div> 
    
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="pwd">House No</label>
               <input type="text" class="form-control" id="pwd" placeholder="Enter house no" name="hno">
           </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="pwd">Locality</label>
               <input type="text" class="form-control" id="pwd" placeholder="Enter locality" name="locality">
           </div>
        </div>
           <div class="col-sm-4">
            <div class="form-group">
                <label for="pwd">PinCode</label>
               <input type="number" class="form-control" id="pwd" placeholder="Enter Pincode" name="pincode">
           </div>
        
        </div>
    </div>
    @include('partials.statecityarea');
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="pwd">Start Date</label>
               <input type="date" class="form-control" name="startdate">
           </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="pwd">End Date</label>
               <input type="date" class="form-control" name="enddate">
           </div>
        </div>
           <div class="col-sm-4">
            <div class="form-group">
                <label for="pwd">Delete Date</label>
               <input type="date" class="form-control" name="deletedate">
           </div>
        
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="pwd">Time</label>
               <input type="number" class="form-control"  placeholder="Hours per day" name="hours">
           </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="pwd">Payment</label>
               <input type="number" class="form-control" placeholder="Payment per hour" name="paymentperhour">
           </div>
        </div>
           
        
        </div>
    
    

        
        <input type="submit" class="btn btn-danger" value="Submit" name="submit">
    </form>
    

</div>

    @endsection