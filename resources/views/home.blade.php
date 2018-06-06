@extends('layouts.app')

@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content')!!}
    </div>
@endif

<div class="container"><br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading animated fInUp">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container"><br><br>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">
                    @foreach($users as $user)
                        <h5><b>Name:</b> &nbsp {{ Auth::user()->fname }} {{ Auth::user()->mname }} {{ Auth::user()->lname }} </h5>
                        <h5><b>User Type:</b> &nbsp{{ $user->usertype }} </h5>
                        <h5><b>Email:</b> &nbsp{{ Auth::user()->email }}</h5>
                        <h5><b>Contact:</b> &nbsp{{ Auth::user()->contact }}</h5>
                        <h5><b>State:</b>&nbsp{{ $user->statename }}</h5>
                        <h5><b>City:</b>&nbsp{{ $user->cityname }}</h5>
                        <h5><b>Area:</b>&nbsp{{ $user->areaname }}</h5>
                    @endforeach  
                        </div>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
