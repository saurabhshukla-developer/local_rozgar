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
            var cityid = $(this).val();
            //console.log(cityid);
            var div = $(this).parent();
            var op = " ";
            $.ajax({
                type:'get',
                url:'/findarea',
                data:{'id':cityid},
                success:function(data){
                    op += '<option value="0" selected disabled> Choose Area </option>';
                    for(var i=0; i<data.length; i++){
                        op += '<option value = "' + data[i].id + '">' + data[i].areaname + '</option>';
                    }

                    div.find('.areas').html(" ");
                    div.find('.areas').append(op);
                }
            });
        });
    });
  
</script>



            <select class="states" id="stateid" name="state" style="height:36px;width:300px;margin-right:45px;">
            
                <option value="0" disabled="true" selected="true">Select State</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->statename }}</option>
                @endforeach
            </select>
     
       
                <select class="cities" id="cityid" name="city" style="height:34px;width:300px;margin-right:45px">
                    <option value="0" disabled="true" selected="true">Select City</option>
                </select>
         

        
                <select class="areas" id="areaid" name="area" style="height:36px;width:300px;">
                    <option value="0" disabled="true" selected="true">Select Area</option>
                </select>
          
