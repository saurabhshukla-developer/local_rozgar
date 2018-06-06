@extends('layouts.app')

@section('content')

<div class="container">
<h4 class="text-center fInUp animated">Users Details</h4>
<div class="table-responsive">
<table class="table">
<tr>
    
    <th>Name</th>
    <th>Email</th>
    <th>Contact</th>
    
    <?php if($usertypeids < 5){ ?>
    <th>State</th>
    <?php } ?>
    <?php if($usertypeids == 5){ ?>
    <th>City</th>
    <?php } ?>
    <?php if($usertypeids == 6){ ?>
    <th>Area</th>
    <?php } ?>
    
    <th>Show Details</th>
</tr>
@foreach($users as $user)
<tr>
    
    <td>{{ $user->fname }} {{ $user->mname }} {{ $user->lname }}</td>
   <td> {{ $user->email }}</td>
    <td>{{ $user->contact }}</td>
    <?php if($user->usertypeid < 5){ ?>
    <td>{{ $user->statename }}</td>
    <?php } ?>
    <?php if($user->usertypeid == 5){ ?>
        <td>{{ $user->cityname }}</td>
    <?php } ?>
    <?php if($user->usertypeid == 6){ ?>
        <td>{{ $user->areaname }}</td>
    <?php } ?>
    <td><a class="btn btn-primary" href = "/Users/{{ $user->id }}">Show Details</a></td>
  </tr>
    @endforeach
    </table>
    </div>
    </div>
@endsection