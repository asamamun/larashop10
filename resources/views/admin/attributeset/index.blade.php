@extends('layouts.admin')

@section('content')
<style>
    .attlist{
        list-style-type:none;
    }
    
fieldset 
	{
		border: 1px solid #ddd !important;
		margin: 0;
		xmin-width: 0;
		padding: 10px;       
		position: relative;
		border-radius:4px;
		background-color: cornsilk;
		padding-left:10px!important;
        text-align: center;
	}	
	
legend
	{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px;
			width: 35%; 
			border: 1px solid #ddd;
			border-radius: 4px; 
			padding: 5px 5px 5px 10px; 
			background-color: #ffffff;
	}

</style>
<h3>Attribute Set management</h3>
<button class="btn btn-primary pull-right" id="createAttribset">Create AttributeSet</button><br><br>       

            <div class="panel panel-info" id="attribsetform">
                <div class="panel-heading">Attribute Set</div>

                <div class="panel-body">
                    <form id="form" class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="attribsetid" value=""/>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
                                <input id="content" type="text" class="form-control" name="content" value="{{ old('content') }}" required autofocus>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                      


        <div class="checkbox" id="attributecontainer">      
                    
            <?php 
            $general_group = "";
            $other_group = "";
            ?>
            @foreach($attributes as $a)
                
            <span class="attlist">
            
            @if($a->attgroup == "general")
               <?php
                $general_group .= '<label style="color: #000; padding:15px;"><input class="attributecls" type="checkbox"  value="'.$a->id.'" checked disabled>'.$a->name.'</label>';
                ?>
               
                
            @else
               
               <?php
                $other_group .= '<label style="color: #000; padding:15px;"><input class="attributecls" type="checkbox"  value="'.$a->id.'">'.$a->name.'</label>';
                ?>
                
            @endif               
            
            </span>
            
            @endforeach
            <fieldset>    	
            <legend class="center">General</legend>
            <?php echo $general_group;?>
            </fieldset>
            <br>
            <fieldset>    	
            <legend class="center">Others</legend>
            <?php echo $other_group;?>
            </fieldset>          
           
        </div>


                        
                        <!--div class="form-group">
                        <fieldset class="col-md-12">    	
		<legend class="center">Attributes</legend>	
                                        <div class="panel panel-default">
                                            <div class="panel-body">                      
			<p>
                                                    @foreach($attributes as $a)
                                                        <label><input type="checkbox" class="attributecls" value="{{$a->id}}"/>{{$a->name}}</label>
                                                    @endforeach
			</p>
                        
                                            </div>
                                        </div>					
                        </fieldset>
                        </div-->
						
                        <!--div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" class="btn btn-warning btn-xs" id="addbtn">
                                    ADD
                                </button>
                                <button type="button" class="btn btn-warning btn-xs" id="updatebtn">
                                    Update
                                </button>
                                <button type="button" class="btn btn-danger btn-xs" id="closeformbtn">
                                    Close
                                </button>                                
                            </div>
                        </div-->
                    </form>
                </div>
            </div>
        
<!-- flash message -->
@if(Session::has('message'))
<div class="alert alert-info">
{{ Session::get('message') }}
</div>
@endif
<!-- flash message -->

<table class="table table-hover" style="border:1px solid #ccc">
        <thead>
            <tr style="background-color:#ffcc99;color:#cc6600;">
                <th>Attribute Name</th>
                <th>Content</th>
                <th>Action</th>
            </tr>
        </thead>
@foreach($attribsets as $attribset) 
        <tbody>  
            <tr>
                <td class="namecontainer">{{ $attribset["name"] }}</td>
                <td class="contentcontainer">{{ $attribset["content"] }}</td>
                <td class="actioncontainer"><button class="btn btn-warning btn-xs btn-detail editbtn" value="{{$attribset->id}}">Edit</button>
                    <button class="btn btn-danger btn-xs btn-detail deletebtn" value="{{$attribset->id}}">Delete</button>
                </td>
            </tr>
@endforeach
</tbody>
</table>
{{$attribsets->links()}}
@endsection

@section('scripts')
<script>
$(document).ready(function(){
	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	var url = "{{URL::to('/')}}";
    
    // attributesetForm start
    $("#attribsetform").hide();
    //closeformbtn
    $("#closeformbtn").click(function(){
        $("#attribsetform").hide(400);
        clearform();
    });
    
    $("#createAttribset").click(function(){
        $("#attribsetform").toggle(400);
         $("#updatebtn").hide(); 
        $("#addbtn").show();
        clearform();
    });
    // attributesetForm end
    
    
	//delete start
	$(".actioncontainer").on("click",".deletebtn",function(){
		//alert(url + '/admin/attributeset/' + $(this).val());
		$.ajax({

            type: "DELETE",
            url: url + '/admin/attributeset/' + $(this).val(),
            success: function (data) {
                alert(data.message);
                location.reload();

                //$("#task" + task_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
		//
	});
	//delete end
	
	//add start
	$("#addbtn").click(function(){
	    //alert($("#name").val() + ": " +$("#content").val() );
        if($("#name").val() == "" || $("#content").val() == ""){
            alert("name and content required");
            return;
        }
		//alert(typeof showSelectedValues());return;
        $.ajax({
            type: "POST",
            url: url + '/admin/attributeset',
			data:{
				name:$("#name").val(),
				content:$("#content").val(),
				att:showSelectedValues(),
			},
            success: function (data) {
               // console.log(data);
                alert(data.message);
                location.reload();

                //$("#task" + task_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
		//
		
	});
	//add end
    
    //edit start
	$(".actioncontainer").on("click",".editbtn",function(){
        
        $("#attribsetform").show(400);
        $("#addbtn").hide();
        $("#updatebtn").show();
        //
        $.ajax({
            type: "GET",
            url: url + '/admin/attributeset/'+$(this).val()+'/edit',
			success: function (data) {
				//console.log(data);
                $("#attribsetid").val(data.asi.id);
                $("#name").val(data.asi.name);
                $("#content").val(data.asi.content);               
                //console.log(data.asia);
				//first uncheck all checked values
				$("#attributecontainer input[type='checkbox']").prop('checked',false);
				$.each(data.asia, function (index, value) {					
    $("#attributecontainer input[type='checkbox'][value=" + value.id + "]").prop("checked", true);
});
			   
                
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
		//
        //

	});
	//edit end
    
    
    //update start
    $("#updatebtn").click(function(){
            $.ajax({
            type: "PUT",
            url: url + '/admin/attributeset/'+$("#attribsetid").val(),
            data:{
				name:$("#name").val(),
				content:$("#content").val(),
                att:showSelectedValues(),
			},    
			success: function (data) {
                alert(data.message);
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    //update end
    
    //clearform
    
    function clearform(){
        $("#form")[0].reset();
    }
    
    //clearform
	
	//get checkbox values
	function showSelectedValues()
{
return $("input.attributecls:checked").map(
     function () {return this.value;}).get().join(",");
}
	
});
</script>

@endsection
