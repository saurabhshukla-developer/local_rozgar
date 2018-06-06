@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@foreach ($labours as $labour)

<div class="container">
<form class="form-horizontal" action="{{route('LabourDetails.update', [$labour->id])}}" method="POST" style=" padding:20px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc;">
{{csrf_field()}}
<input type="hidden" name="_method" value="put">
    <div class="form-group">
      <label class="control-label col-sm-2">First Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter First name" name="fname" value="{{ $labour->fname }}">
      </div>
    </div>
    
	<div class="form-group">
      <label class="control-label col-sm-2">Middle Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter middle name" name="mname" value="{{ $labour->mname }}">
      </div>
    </div>
	
	<div class="form-group">
      <label class="control-label col-sm-2" >Last Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter Last name" name="lname" value="{{ $labour->lname }}">
      </div>
    </div>
	
	<div class="form-group">
      <label class="control-label col-sm-2">Contact No</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" placeholder="Enter your no" name="contact" value="{{ $labour->contact }}">
      </div>
    </div>
	
	<div class="form-group">
      <label class="control-label col-sm-2">Age</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" placeholder="Enter your age" name="age" value="{{ $labour->age }}">
      </div>
    </div>
	
	<div class="form-group">
    <label class="control-label col-sm-2">Gender</label>
      <div class="col-sm-10">
      <select class="form-control" name="gender">
      @if($labour->gender == 'Male')
        <option value="Male" selected="true">Male</option>
			  <option value="Female">Female</option>
      @else
			  <option value="Male">Male</option>
		  	<option value="Female" selected="true">Female</option>
      @endif
	  </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Pincode</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" placeholder="Enter your Pincode" name="pincode" value="{{ $labour->pincode }}">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Adhar No</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" placeholder="Enter your Adhar no" name="adhar" value="{{ $labour->adhar }}">
      </div>
    </div>
	
	<div class="form-group">
    <label class="control-label col-sm-2">Labour Type</label>
      <div class="col-sm-10">
      <select class="form-control" name="labourtype">
			<option value="0" disabled="true" selected="true">Select Labour Type</option>
            @foreach($labourtypes as $labours)
              @if($labours->id == $labour->labourtypeid)
                <option value="{{ $labours->id }}" selected="true">{{ $labours->labourtype }}</option>
              @else
                <option value="{{ $labours->id }}">{{ $labours->labourtype }}</option>
              @endif
            @endforeach
			
	  </select>
      </div>
    </div>

    <div class="form-group">
    <label class="control-label col-sm-2">Approval</label>
      <div class="col-sm-10">
      <select class="form-control" name="flag">
      @if($labour->flag == 1)
        <option value="1" selected="true">Approved</option>
			  <option value="0">Not Approved</option>
      @else
			  <option value="1">Approved</option>
		  	<option value="0" selected="true">Not Approved</option>
      @endif
	  </select>
      </div>
    </div>


    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="Update" name="submit">
      </div>
    </div>
  </form>
  </div>
  @endforeach
@endsection