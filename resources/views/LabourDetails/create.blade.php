@extends('layouts.app')

@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content')!!}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<body>
    <div class="container-fluid">
        <h2 class="text-center animated fInUp">Register Yourself here</h2><br><br>
        <div class="container">
                
                        
            <form class="form-horizontal" action="{{route('LabourDetails.store')}}" method="POST" style=" padding:40px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc; ">
            {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="email">First Name</label>
                        <input type="name" class="form-control" id="email" placeholder="Enter first name" name="fname">
                    </div>
                  </div>
                <div class="col-sm-4">
                        <div class="form-group">
                         <label for="email">Middle Name</label>
                           <input type="name" class="form-control" id="email" placeholder="Enter middle sname" name="mname">
                        </div>
                       </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                        <label for="email">Last Name</label>
                          <input type="name" class="form-control" id="email" placeholder="Enter last name" name="lname">
                      </div>
                  </div> 
                </div> 
                <div class="row">   
                    <div class="col-sm-4">
                 <div class="form-group">
                     <label for="pwd">Contact No</label>
                    <input type="number" class="form-control" id="pwd" placeholder="Enter number" name="contact">
                </div>
            </div> 
            <div class="col-sm-4">
                    <div class="form-group">
                            <label for="pwd">Adhar No</label>
                           <input type="number" class="form-control" id="pwd" placeholder="Enter adhar number" name="adhar">
                       </div>
            </div>
            <div class="col-sm-4">
                    <div class="form-group">
                            <label for="pwd">Gender</label>
                           <select class="form-control" name="gender">
                               <option value="Male">Male</option>
                               <option value="Female">Female</option>
                           </select>
                        </div>
            </div>
            </div> 
            <div class="row">
            @include('partials.statecityarea');
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                        <div class="form-group">
                                <label for="pwd">Age</label>
                               <input type="number" class="form-control" id="pwd" placeholder="Enter age" name="age">
                           </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="pwd">Pincode</label>
                       <input type="number" class="form-control" id="pwd" placeholder="Enter your Pincode" name="pincode">
                   </div>
                </div>
                <div class="col-sm-4">
                        <div class="form-group">
                                <label for="pwd">Labour Type</label>
                               <select class="form-control" name="labourtype">
                               <option value="0" disabled="true" selected="true">Select Labour Type</option>
                               @foreach($labourtype as $labour)
                                   <option value="{{ $labour->id }}">{{ $labour->labourtype }}</option>
                                @endforeach   
                               </select>
                            </div>
                </div>

            </div>  
            
                <input type="submit" class="btn btn-danger" value="Submit" name="submit">
            </form>
            

        </div>
        
    </div>
    @endsection