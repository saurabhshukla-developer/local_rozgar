@extends('layouts.app')

@section('content')
<br><br><br>
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
<div class="container">

<form class="form-horizontal" action="{{route('LabourTypes.store')}}" method="POST" style=" padding:40px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc; ">
{{csrf_field()}}
    <div class="form-group">
      <label class="control-label col-sm-2">Labour Type Name</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="labourtype">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="Add" name="submit">
      </div>
    </div>
  </form>
  </div>
@endsection