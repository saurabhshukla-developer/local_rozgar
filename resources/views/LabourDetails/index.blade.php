@extends('layouts.app')
@section('content')


<div class="container-fluid">

<br>
@if(Auth::check())
<?php if(Auth::user()->usertypeid < 3){ ?>
    
        <div class="panel panel-default">
            <div class="panel-header">
               <h2 class="text-center"> Information</h2>
            </div><hr>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6"><b>
                        <h5>Total approved labours of this area and this type:</h5>
                    @foreach($labourcountat as $labour)
                        {{ $labour->labourcountat }}
                    @endforeach
                </div>
                <div class="col-sm-6">  
                    <h5>
                    Total unapproved labours of this area and this type:</h5>
                    @foreach($labourcountn as $labour)
                        {{ $labour->labourcountn }}
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h5>
                    Total approved labours of this state and this type:</h5>
                    @foreach($labourcountast as $labour)
                        {{ $labour->labourcountast }}
                    @endforeach
                </div>
                <div class="col-sm-6">
                    <h5>
                    Total approved labours of this state:</h5>
                    @foreach($labourcountas as $labour)
                        {{ $labour->labourcountas }}
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                <h5>
                Total approved labours of this city and this type:</h5>
                @foreach($labourcountact as $labour)
                    {{ $labour->labourcountact }}
                @endforeach
                </div>
            <div class="col-sm-6">
                <h5>
                Total approved labours of this city:</h5>
                @foreach($labourcountac as $labour)
                    {{ $labour->labourcountac }}
                @endforeach
            </div>
        </div>
    </div>
</div>
<?php } ?>
<br>


    

<h4 class="text-center animated fInLeft"><b>Unapproved Labours:</b></h4>
@foreach($labourcountn as $labour)
        <?php if($labour->labourcountn > 0){ ?>

<div class="table-responsive">
<table class="table">
<tr>
    <th>Name</th>
    <th>Adhar</th>
    <th>Age</th>
    <th>Contact</th>
    <th>Gender</th>
    <th>Pincode</th>
    <th>Edit</th>
    <th>Delete</th>
 
</tr>

    @foreach($laboursn as $labour)
    <tr>
          <td>  {{ $labour->fname }} {{ $labour->mname }} {{ $labour->lname }}</td>
            <td>{{ $labour->adhar }}</td>
            <td>{{ $labour->age }}</td>
            <td>{{ $labour->contact }}</td>
            <td>{{ $labour->gender }}</td>
            <td>{{ $labour->pincode }}</td>
            
           <td> <a class="btn btn-primary" href = "/LabourDetails/{{ $labour->id }}/edit">Edit</a></td>
           <td> <form class="delete" action="/LabourDetails/{{ $labour->id }}" method="POST">
           {{ csrf_field() }}
           <input type="hidden" name="_method" value="delete">
           <input type="hidden" name="id" value="{{ $labour->id }}" readonly>
           <input type="submit" class="btn btn-danger" name="delete" value="Delete">
            </td>
        </tr>
        </form>
    @endforeach
    
    <script>
        $(".delete").on("submit", function(){
            return confirm("Do you want to delete?");
        });
    </script>
        <?php }
        else{
            echo "No unapproved labours in this category!";
        } ?>
@endforeach
    
@endif
</table>
</div>
<br><br>


<h4 class="text-center animated fInRight"><b>Approved Labours:</b></h4>
@foreach($labourcountat as $labour)
        <?php if($labour->labourcountat > 0){ ?>

<div class="table-responsive">
<table class="table">
<tr>
    <th>Name</th>
    <th>Adhar</th>
    <th>Age</th>
    <th>Contact</th>
    <th>Gender</th>
    <th>Pincode</th>
    @if(Auth::check())
    <th>Edit</th>
    <th>Delete</th>
    @endif
</tr>
@foreach($laboursa as $labour)
<tr>
          <td>  {{ $labour->fname }} {{ $labour->mname }} {{ $labour->lname }}</td>
            <td>{{ $labour->adhar }}</td>
            <td>{{ $labour->age }}</td>
            <td>{{ $labour->contact }}</td>
            <td>{{ $labour->gender }}</td>
            <td>{{ $labour->pincode }}</td>
    
            @if(Auth::check())
            <td><a class="btn btn-primary" href = "/LabourDetails/{{ $labour->id }}/edit">Edit</a></td>
            <td><a class="btn btn-danger" href = "#" onclick="
                document.getElementById('delete-form').submit();">Delete</a>

            <form id="delete-form" action="/LabourDetails/{{ $labour->id }}" method="Post" style="display:none;">
            <input type="hidden" name="_method" value="delete">
            {{ csrf_field() }}
            </form></td>
            @endif

        </tr>
         @endforeach
         <?php }
        else{
            echo "No approved labours in this category!";
        } ?>
        @endforeach
       </table> 
       </div>
       </div> 

@endsection