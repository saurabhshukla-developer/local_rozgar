@extends('layouts.app')

@section('content')

<div class="container">
<div class="col-md-6 col-md-offset-4">
<div class="panel panel-default">
<div class="panel-header"><h4 class="text-center animated fInUp">Work Details</h4></div><hr>
    <div class="panel-body">
    
@foreach($works as $work)
           <div class="form-group">
                <label class="control-label">Name:</label>
                 {{ $work->fname }} {{ $work->mname }} {{ $work->lname }}
           </div>
           <div class="form-group">
                <label class="control-label">Contact:</label>
                {{ $work->contact }}
            </div>
            <div class="form-group">
                <label class="control-label">Work Type</label>
                {{ $work->worktype }}
             </div>   
             <div class="form-group">
                <label class="control-label">Description</label>
                {{ $work->description }}
             </div>  
             <div class="form-group">
                <label class="control-label">Start Date</label>  
                 {{ $work->startdate }}
             </div>
             <div class="form-group">
                <label class="control-label">End Date</label>     
                    {{ $work->enddate }}
              </div>
              <div class="form-group">
                <label class="control-label">Time(in hours)</label>      
                   {{ $work->hours }}
               </div>
               <div class="form-group">
                <label class="control-label">Payment(per hour)</label>     
                   {{ $work->paymentperhour }}
                </div>
                <div class="form-group">
                <label class="control-label">Pincode</label>    
                    {{ $work->pincode}}
                 </div>
                 <div class="form-group">
                        <label class="control-label">House No</label>   
                   {{ $work->hno }}
                  </div>
                  <div class="form-group">
                <label class="control-label">Locality</label>  
                   {{ $work->locality }}
                                     </div>
                  <div class="form-group">
                <label class="control-label">State</label>  
                {{ $work->statename }}
                <div>
                <div class="form-group">
                <label class="control-label">City</label>
                   {{ $work->cityname }}
                  </div>
                  <div class="form-group">
                <label class="control-label">Area</label>  
                  {{ $work->areaname }}
                   </div> 
                
                   <div class="col-md-4 col-md-offset-2">
                    @if(Auth::check())
            <a class="btn btn-primary pull-left" href = "/WorkDetails/{{ $work->id }}/edit">Edit</a>
            <form action="/WorkDetails/{{ $work->id }}" method="POST">
           {{ csrf_field() }}
           <input type="hidden" name="_method" value="delete">
           <input type="hidden" name="id" value="{{ $work->id }}" readonly>
           <input type="submit" class="btn btn-primary pull-right" name="delete" value="Delete">
           
            @endif
            </div> 
         @endforeach
        
         </div>
      </div>   
</div>  

         </div>
@endsection
