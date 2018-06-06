@extends('layouts.app')

@section('content')

<div class="container">
@if(Auth::check())
<h4 class="text-center animated fInLeft"><b>Unapproved Work:</b></h4>
@foreach($workcountn as $work)
        <?php if($work->workcountn > 0){ ?>
<div class="table-responsive">
<table class="table table-bordered">
<tr>
    <th>Name</th>
    <th>Work Type</th>
    <th>Contact</th>
    <th>Start Date</th>
    <th>Show Details</th>
</tr>

    @foreach($worksn as $work)
    <tr>
           <td> {{ $work->fname }}{{ $work->mname }} {{ $work->lname }}</td>
           <td> {{ $work->worktype}}</td>
           <td> {{ $work->contact}}</td>
           <td> {{ $work->startdate}}</td>
            
           
             <td><a href = "/WorkDetails/{{ $work->id }}">Show Details</a></td>
            
             </tr>
         @endforeach
         
         </table>
         </div>
         
                                    <?php }
                            else{
                                echo "<br>";
                                echo "<center>";
                                 echo "No unapproved work in this category!";
                                 echo "</center>";
                            } ?>
                            

@endforeach
@endif

<h4 class="text-center animated fInRight"><b>Approved Work:</b></h4>
@foreach($workcounta as $work)
        <?php if($work->workcounta > 0){ ?>
<div class="table-responsive">
<table class="table table-bordered">
<tr>
<th>Name</th>
    <th>Work Type</th>
    <th>Contact</th>
    <th>Start Date</th>
    <th>Show Details</th>
</tr>

@foreach($worksa as $work)
<tr>
<td> {{ $work->fname }}{{ $work->mname }} {{ $work->lname }}</td>
<td> {{ $work->worktype}}</td>
<td> {{ $work->contact}}</td>
<td> {{ $work->startdate}}</td>
            <td> <a href = "/WorkDetails/{{ $work->id }}">Show Details</a></td>
            </tr>       
         @endforeach
         
         </table>
         </div>
         </div>
         <?php }
        else{
            echo "<br>";
            echo "<center>";
            echo "No approved work in this category!";
            echo "</center>";
        } ?>
@endforeach

@endsection
