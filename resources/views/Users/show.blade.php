@extends('layouts.app')

@section('content')
<div class="container">


   <h4 class="text-center fInUp animated">Details of Users</h4> 
<form class="form" style=" padding:40px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc; ">

@foreach($users as $user)
        <div class="form-group">
        <label>Name</label>
        <input class="form-control col-sm-6" type="text" value="{{ $user->fname }} {{ $user->lname }} {{ $user->lname }}" readonly>
        </div>
        <div class="form-group">
        <label>Contact</label>
        <input class="form-control col-sm-6" type="text" value=" {{ $user->contact }}" readonly>
        </div>
        <div class="form-group">
        <label>Email</label>
        <input class="form-control col-sm-6" type="text" value="{{ $user->email }}" readonly>
        

        <div class="form-group">
        <label>User Type</label>
        <input class="form-control col-sm-6" type="text" value="{{ $user->usertype}}" readonly>
        </div>

        <div class="form-group">
        <label>State</label>
        <input class="form-control col-sm-6" type="text" value="{{ $user->statename}}" readonly>
        </div>

        <div class="form-group">
        <label>City</label>
        <input class="form-control col-sm-6" type="text" value="{{ $user->cityname}}" readonly>
        </div>

        <div class="form-group">
        <label>Area</label>
        <input class="form-control col-sm-6" type="text" value="{{ $user->areaname}}" readonly>
        </div>

        <div class="form-group">
        <label>Pincode</label>
        <input class="form-control col-sm-6" type="text" value="{{ $user->pincode}}" readonly>
        </div>
        
</form>
         <br>  <br> 
          <?php if((Auth::user()->usertypeid < 4) || ((Auth::user()->usertypeid == 4) && ($user->stateid == $user_place->stateid))){ ?>
           <td> <a class="btn btn-primary" href = "/Users/{{ $user->id }}/edit">Edit</a></td>
          <td>  <a  class="btn btn-primary" href = "#" onclick="
                document.getElementById('delete-form').submit();">Delete</a>

            <form id="delete-form" action="/Users/{{ $user->id }}" method="Post" style="display:none;">
            <input type="hidden" name="_method" value="delete">
            {{ csrf_field() }}
            </form></td>
            <?php } ?>

            <?php if((Auth::user()->usertypeid == 5) && ($user->cityid == $user_place->cityid)){ ?>
           <td> <a href = "/Users/{{ $user->id }}/edit">Edit</a></td>
          <td>  <a href = "#" onclick="
                document.getElementById('delete-form').submit();">Delete</a>

            <form id="delete-form" action="/Users/{{ $user->id }}" method="Post" style="display:none;">
            <input type="hidden" name="_method" value="delete">
            {{ csrf_field() }}
            </form></td>
            <?php } ?>
     
          
         @endforeach
         </tr> 
         </table>  
         </div>
         </div>
@endsection
