@extends('layouts.app')

@section('content')

<form action="{{ route('Users.store') }}" method="POST" style=" padding:20px;
            box-shadow:10px 10px 5px rgba(6,1,1,0.43) ">
{{csrf_field()}}

<script type = "text/javascript">
    $(document).ready(function(){
        ////console.log("hey something happened!");
        $(document).on('change','.roles',function(){
            ////console.log("hey something is selected");
            ////console.log("it changed");
            var op = " ";
            var div = $(this).parent();
            var usertypeid = $(this).val();
            ////console.log(stateid);
            if(usertypeid >= 5){
                var div = $(this).parent();
                //console.log("div is");
                //console.log(div);
                op += '<select class="states" id="stateid" name="state" style="height:36px;width:330px">';
                op += '<option value="0" selected disabled> Choose State </option>';
                var complex = <?php echo json_encode($states); ?>;
                ////console.log(complex);
                for(var i=0; i<complex.length; i++){
                        op += '<option value = "' + complex[i].id + '">' + complex[i].statename + '</option>';
                    }
                op += "</select>";
                
            }
            else{
                op += " ";
            }
            div.find('.cities').html(" ");
                div.find('.cities').append(op);
        });
            
                $(document).on('change','.states',function(){
                    var usertypeid = document.getElementById('roleid').value; 
                    //console.log("state is changed");
                    //console.log(usertypeid);
                   
                    if(usertypeid == 6){
                        var stateid = $(this).val();
                        ////console.log("stateid");
                       // //console.log(stateid);
                        var divs = $(this).parent();
                        var ops = '<select class="cities" id="cityid" name="city" style="height:36px;width:330px">';
                        ////console.log(ops);
                        $.ajax({
                            
                            type:'get',
                            url:'/findcity',
                            data:{'id':stateid},
                            success:function(data){
                                ////console.log("hey there, im inside function");
                                ////console.log(ops);
                                ops += '<option value="0" selected disabled> Choose City </option>';
                                for(var i=0; i<data.length; i++){
                                // //console.log("inside for");
                                //  //console.log(data[i].cityname);
                                    ops += '<option value = "' + data[i].id + '">' + data[i].cityname + '</option>';
                                }
                                ops += "</select>";
                                ////console.log(ops);
                                document.getElementById("areas").innerHTML = ops;
                                //document.write(ops);
                                //divs.find('.areas').html(" ");
                                //divs.find('.areas').append(ops);
                                
                            }
                        })
       
                    }
                   
                   
        
    });
    });
</script>
<div class="container">
<h4 class="text-center animated fInUp"><strong>Enter your credentials</strong></h4><br><br>
<select class="roles" id="roleid" name="usertypeid" style="height:36px;width:330px" required>
			<option value="0" disabled="true" selected="true">Select User</option>
            @foreach($usertypes as $users)
                @if(Auth::user()->usertypeid < $users->id)
                    <option value="{{ $users->id }}">{{ $users->usertype }}</option>
                @endif
            @endforeach
			
	  </select>
      
      <p class="cities"></p>

      <p class="areas" id="areas"></p>

       
     
        <input type="submit" class="btn btn-primary" value="Submit" name="submit">
     
    </div>

</form>
</div>

@endsection