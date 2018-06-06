@extends('layouts.app')

@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content')!!}
    </div>
@endif

<script type = "text/javascript">
    $(document).ready(function(){
        console.log("hey something happened!");
        $(document).on('change','.states',function(){
            console.log("hey something is selected");
            //console.log("it changed");
            var stateid = $(this).val();
            console.log(stateid);
            var div = $(this).parent();
            var op = " ";
            $.ajax({
                type:'get',
                url:'/findcity',
                data:{'id':stateid},
                success:function(data){
                    console.log("hey im inside");
                    op += '<div class="table-responsive">'
                    op += '<table class="table table-bordered">';
                    op += '<tr>';
                    op += '<th>City</th>';
                    op += '<th>Edit</th>';
                    op += '<th>Delete</th>';
                    op += '</tr>';
                    op += '<tr>';
                    for(var i=0; i<data.length; i++){
                       console.log("hii baby");
                       op += '<td>' + data[i].cityname + '</td>';
                       //op += '<li>' + data[i].id;
                       if(({{ Auth::user()->usertypeid }} < 4 ) || (({{ Auth::user()->usertypeid }} == 4 ) && ({{ $user_place->stateid}} == stateid))){

                       op += '<td> <a class="btn btn-primary" href = "/Cities/' + data[i].id + '/edit">Edit</a> </td>';
                       op += '<td>'
                       op += '<form action="/Cities/' + data[i].id + '" method="POST"> {{ csrf_field() }}';
                       op += '<input type="hidden" name="_method" value="delete">';
                       op += '<input type="hidden" name="id" value="' + data[i].id + '" readonly>';
                       op += '<input class="btn btn-danger" type="submit" name="delete" value="Delete"></form>';
                       op += '</td>'
                       }
                       op += '</tr>';
                    }
                    op += '</table>';
                    op += '</div>'
                    
                    if(({{ Auth::user()->usertypeid }} < 4 ) || (({{ Auth::user()->usertypeid }} == 4 ) && ({{ $user_place->stateid}} == stateid))){
                        op += '<a href="/Cities/' + stateid + '" class="btn btn-primary">Add City in this State</a>';
                    }
                    div.find('.cities').html(" ");
                    div.find('.cities').append(op);
                }
            });
        });
    });
    
</script>
<div class="container">
<h4 class="text-center animated fInUp">Enter your credentials</h4><br><br>
<form class="form" style=" padding:20px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc; ">
<select class="states" id="stateid" name="state"  style="height:36px;width:330px">
                <option value="0" disabled="true" selected="true">Select State</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->statename }}</option>
                @endforeach
            </select>
            <br>
           
            <p class="cities"></p>
            <br>
</form>
   </div>       
@endsection