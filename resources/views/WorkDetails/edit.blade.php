@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h4 class="text-center animated fInUp"><b>>Edit Work Details<b></h4>
@foreach ($works as $work)

<form class="form" action="{{route('WorkDetails.update', [$work->workid])}}" method="POST" style=" padding:40px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc; ">
{{csrf_field()}}
<input type="hidden" name="_method" value="put">

    <div class="form-group">
      <label class="control-label col-sm-2">First Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter First name" name="fname" value="{{ $work->fname }}">
      </div>
    </div>
   
    
   
	<div class="form-group">
      <label class="control-label col-sm-2">Middle Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="" placeholder="Enter middle name" name="mname" value="{{ $work->mname }}">
      </div>
    </div>
    
	

	<div class="form-group">
      <label class="control-label col-sm-2" >Last Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter Last name" name="lname" value="{{ $work->lname }}">
      </div>
    </div>
   
    

	<div class="form-group">
      <label class="control-label col-sm-2">Contact No</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" placeholder="Enter your no" name="contact" value="{{ $work->contact }}">
      </div>
    </div>

    <div class="form-group">
    <label class="control-label col-sm-2">Work Type</label>
      <div class="col-sm-10">
            <select class="form-control" name="worktypeid">
            <option value="0" disabled="true" selected="true">Select Work Type</option>
                  
                  @foreach($worktype as $works)
                      @if($works->id == $work->worktypeid)
                          <option value="{{ $works->id }}" selected="true">{{ $works->worktype }}</option>
                      @else
                          <option value="{{ $works->id }}">{{ $works->worktype }}</option>
                      @endif
                  @endforeach

            
          </select>
      </div>
    </div>

   

    <div class="form-group">
      <label class="control-label col-sm-2">Work Description</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter your work Description " name="description" value="{{ $work->description }}">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Start Date</label>
      <div class="col-sm-10">
        <input type="date" class="form-control"  name="startdate" value="{{ $work->startdate }}">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">End Date</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" name="enddate" value="{{ $work->enddate }}">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Delete Date</label>
      <div class="col-sm-10">
        <input type="date" class="form-control"  name="deletedate" value="{{ $work->deletedate }}">
      </div>
    </div>
	
    <div class="form-group">
      <label class="control-label col-sm-2">Time</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" placeholder="In hours" name="hours" value="{{ $work->hours }}">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">House No</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter your house No" name="hno" value="{{ $work->hno }}">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Locality</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter your Locality" name="locality" value="{{ $work->locality }}">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Pincode</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" placeholder="Enter your Pincode" name="pincode" value="{{ $work->pincode }}">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Payment</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="" placeholder="Enter Payment Per hour " name="paymentperhour" value="{{ $work->paymentperhour }}">
      </div>
    </div>
	
    <div class="form-group">
    <label class="control-label col-sm-2">Approval</label>
      <div class="col-sm-10">
      <select class="form-control" name="flag">
      @if($work->flag == 1)
        <option value="1" selected="true">Approved</option>
			  <option value="0">Not Approved</option>
      @else
			  <option value="1">Approved</option>
		  	<option value="0" selected="true">Not Approved</option>
      @endif
	  </select>
      </div>
    </div>

<br><br><br>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="Submit" name="submit">
      </div>
    </div>
  </form>


  @endforeach
  
</div>  
@endsection