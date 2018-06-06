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

<form class="form-horizontal" action="{{route('Areas.store')}}" method="POST" style=" padding:20px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43)background-color:#d5d8dc;">
{{csrf_field()}}

<input type="hidden" name="cityid" value="{{ $cityid }}">
    <div class="form-group">
      <label class="control-label col-sm-4">Area Name</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="areaname">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-4 col-sm-6">
        <input type="submit" class="btn btn-primary" value="Add" name="submit">
      </div>
    </div>
  </form>
  </div>
@endsection