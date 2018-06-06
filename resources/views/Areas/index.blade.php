@extends('layouts.app')

@section('content')

<script type = "text/javascript">
    $(document).ready(function(){
        //console.log("hey something happened!");
        $(document).on('change','.states',function(){
            //console.log("hey something is selected");
            //console.log("it changed");
            var stateid = $(this).val();
            //console.log(stateid);
            var div = $(this).parent();
            var op = " ";
            $.ajax({
                type:'get',
                url:'/findcity',
                data:{'id':stateid},
                success:function(data){
                    op += '<option value="0" selected disabled> Choose City </option>';
                    for(var i=0; i<data.length; i++){
                        op += '<option value = "' + data[i].id + '">' + data[i].cityname + '</option>';
                    }

                    div.find('.cities').html(" ");
                    div.find('.cities').append(op);
                }
            });
        });

        $(document).on('change','.cities',function(){
            //console.log("hey something is selected");
            //console.log("it changed");
            var stateid = document.getElementById('stateid').value;
            var cityid = $(this).val();
            //console.log(cityid);
            var div = $(this).parent();
            var op = " ";
            $.ajax({
                type:'get',
                url:'/findarea',
                data:{'id':cityid},
                success:function(data){
                    //console.log("inside function");
                    op += '<div class="table-responsive">';
                    op += '<table class="table">';
                    op += '<tr>';
                    op += '<th>Area</th>';
                    op += '<th>Edit</th>';
                    op += '<th>Delete</th>';
                    op += '</tr>';
                    op += '<tr>';
                    for(var i=0; i<data.length; i++){
                        op += '<td>' + data[i].areaname + '</td>';
                        if(({{ Auth::user()->usertypeid }} < 4 ) || (({{ Auth::user()->usertypeid }} == 4 ) && ({{ $user_place->stateid}} == stateid)) || (({{ Auth::user()->usertypeid }} == 5 ) && ({{ $user_place->cityid}} == cityid))){
                        op += '<td> <a class="btn btn-primary" href = "/Areas/' + data[i].id + '/edit">Edit</a> </td>';
                        op += '<td>'
                        op += '<form action="/Areas/' + data[i].id + '" method="POST"> {{ csrf_field() }}';
                       op += '<input type="hidden" name="_method" value="delete">';
                       op += '<input type="hidden" name="id" value="' + data[i].id + '" readonly>';
                       op += '<input class="btn btn-danger" type="submit" name="delete" value="Delete"></form>';
                       op += '<td>'
                    }
                    op += '</tr>';
                    }
                    op += '</table>';
                    op += '</div>';
                    if(({{ Auth::user()->usertypeid }} < 4 ) || (({{ Auth::user()->usertypeid }} == 4 ) && ({{ $user_place->stateid}} == stateid)) || (({{ Auth::user()->usertypeid }} == 5 ) && ({{ $user_place->cityid}} == cityid))){
                        op += '<a href="/Areas/' + cityid + '" class="btn btn-primary">Add Area in this City</a>';
                    }
                    div.find('.areas').html(" ");
                    div.find('.areas').append(op);
                }
            });
        });
    });
  
</script>
<div class="container">
<h4 class="text-center animated fInUp">Enter your credentials</h4><br><br>
        <form class="form" style=" padding:20px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43);background-color:#d5d8dc;">
            <select class="states" id="stateid" name="state" style="height:36px;width:330px">
                <option value="0" disabled="true" selected="true">Select State</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->statename }}</option>
                @endforeach
            </select>
     
        
                <select class="cities" id="cityid" name="city" style="height:36px;width:330px">
                    <option value="0" disabled="true" selected="true">Select City</option>
                </select>
          <br><br>
                <p class="areas"></p>
            </form>    
     </div>          
@endsection