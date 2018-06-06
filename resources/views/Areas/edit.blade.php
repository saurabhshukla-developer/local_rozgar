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

<form class="form-horizontal" action="{{route('Areas.update', [$area->id])}}" method="POST" style="margin-top:40px">
{{csrf_field()}}
    <input type="hidden" name="_method" value="put">
    <div class="form-group">
      <label class="control-label col-sm-4">Area Name</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="areaname" value="{{ $area->areaname }}">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-4 col-sm-6">
        <input type="submit" class="btn btn-primary" value="Update" name="submit">
      </div>
    </div>
  </form>
  </div>
@endsection