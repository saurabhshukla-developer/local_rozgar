@extends('layouts.app')

@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content')!!}
    </div>
@endif

<div class="container">
<h4 class="text-center animated fInUp">View States</h4><br>
<div class="table-responsive">
<table class="table">
<tr>
    <th>State Name</th>
    
    @if(Auth::user()->usertypeid < 4 )
   
    <th>Edit</th>
    <th>Delete</th>
    @endif
</tr>

@foreach($states as $state)
<tr>
           <td> {{ $state->statename }}</td>
           @if(Auth::user()->usertypeid < 4 )
           
           <td> <a class="btn btn-primary" href = "/States/{{ $state->id }}/edit">Edit</a></td>
           
           <td> <form action="/States/{{ $state->id }}" method="POST">
           {{ csrf_field() }}
           <input type="hidden"  name="_method" value="delete">
           <input type="hidden" name="id" value="{{ $state->id }}" readonly>
           <input type="submit" class="btn btn-danger" name="delete" value="Delete">
            </form></td>

            @endif
</tr>
@endforeach
         </table>
         </div><br>
         @if(Auth::user()->usertypeid < 4 )
         <a class="btn btn-primary pull-right" href = "/States/create">Add New State</a>
         @endif
         </div> 
@endsection