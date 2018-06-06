@extends('layouts.app')

@section('content')

<div class="container">
<h4 class="text-center animated fInUp">View Labour Types</h4><br>
<div class="table-responsive">
<table class="table">
<tr>
    <th>Labour Type</th>
    <?php if(Auth::user()->usertypeid < 4){ ?>
    <th>Edit</th>
    <th>Delete</th>
<?php } ?>
</tr>

@foreach($labourtypes as $labourtype)
         <tr>   
          <td>  {{ $labourtype->labourtype }}</td>
          <?php if(Auth::user()->usertypeid < 4){ ?>
            <td><a class="btn btn-primary" href = "/LabourTypes/{{ $labourtype->id }}/edit">Edit</a></td>
           <td><form action="/LabourTypes/{{ $labourtype->id }}" method="POST">
           {{ csrf_field() }}
           <input type="hidden" name="_method" value="delete">
           <input type="hidden" name="id" value="{{ $labourtype->id }}" readonly>
           <input class="btn btn-danger" type="submit" name="delete" value="Delete">
            </form></td>
            <?php } ?>
          <tr>
         @endforeach
         </table>
         </div>
         <br>
         <?php if(Auth::user()->usertypeid < 5){ ?>
         <a class="btn btn-primary pull-right" href = "/LabourTypes/create">Add New Labour Type</a>
         <?php } ?>
         </div>
@endsection