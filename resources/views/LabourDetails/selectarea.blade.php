@extends('layouts.app')

@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content')!!}
    </div>
@endif

<div class="container">
<h4 class="text-center animated fInUp">Enter your credentials</h4>
<form action="{{ route('LabourDetails.index') }}" method="GET" style=" padding:20px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc; ">
{{csrf_field()}}
<div class="row">
@include('partials.statecityarea');
</div>
<br>
<div class="row">
  <div class="col-sm-4">
      <div class="form-group">
            <label class="control-label">Labour Type</label><br>
              
              <select class="form-control" name="labourtype">
                <option value="0" disabled="true" selected="true">Select Labour Type</option>
                      @foreach($labourtypes as $labour)
                          <option value="{{ $labour->id }}">{{ $labour->labourtype }}</option>
                      @endforeach
                
              </select>
            
          </div>
      </div>
    </div>
<br><br>
     
     
        <input type="submit" class="btn btn-primary" value="Submit" name="submit">
      

</form>
</div>

@endsection