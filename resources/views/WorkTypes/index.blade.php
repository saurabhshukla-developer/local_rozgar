@extends('layouts.app')

@section('content')
<div class="container">
<h4 class="text-center animated fInUp">View Work Details</h4><br>
<div class="table-responsive">
<table class="table">
<tr>
    <th>Work Type</th>
    <?php if(Auth::user()->usertypeid < 4){ ?>
        
        <th>Edit</th>
        <th>Delete</th>
    <?php } ?>
</tr>

@foreach($worktypes as $worktype)
           <tr> 
           <td> {{ $worktype->worktype }}</td>
           <?php if(Auth::user()->usertypeid < 4){ ?>
            
            <td><a class="btn btn-primary" href = "/WorkTypes/{{ $worktype->id }}/edit">Edit</a></td>
           <td> <form action="/WorkTypes/{{ $worktype->id }}" method="POST">
           {{ csrf_field() }}
           <input type="hidden" name="_method" value="delete">
           <input type="hidden" name="id" value="{{ $worktype->id }}" readonly>
           <input class="btn btn-danger" type="submit" name="delete" value="Delete">
            </form></td>
            <?php } ?>
          </tr>
         @endforeach

</table>
</div>
<br>
    <?php if(Auth::user()->usertypeid < 5){ ?>
         <a class="btn btn-primary pull-right" href = "/WorkTypes/create">Add New work Type</a>
         <?php } ?>
     </div>

@endsection