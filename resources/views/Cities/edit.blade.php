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

<form class="form-horizontal" action="{{route('Cities.update', [$city->id])}}" method="POST" style=" padding:40px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc; ">
{{csrf_field()}}
    <input type="hidden" name="_method" value="put">
    <div class="form-group">
      <label class="control-label col-sm-4">City Name</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="cityname" value="{{ $city->cityname }}">
        </div>
    </div>

    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
        <input type="submit" class="btn btn-primary" value="Update" name="submit">
      </div>
      </div>
  </form>
</div>
@endsection