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

<form class="form-horizontal" action="{{route('Cities.store')}}" method="POST" style=" padding:40px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc; ">
{{csrf_field()}}

<input type="hidden" name="stateid" value="{{ $stateid }}">
    <div class="form-group">
      <label class="control-label">City Name</label>
      
        <input type="text" class="form-control" name="cityname">
     
    </div>
<br>
   
        <input type="submit" class="btn btn-primary" value="Add" name="submit">
      
  </form>
</div>
@endsection