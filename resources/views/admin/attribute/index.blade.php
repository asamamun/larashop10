@extends('layouts.admin')

@section('content')
<h3>Attribute management</h3>
<button class="btn btn-primary pull-right" id="createAttribute">Create Attribute</button><br><br>       

            <div class="panel panel-info" id="attributeform">
                <div class="panel-heading">Attribute</div>

                <div class="panel-body">
                    <form id="form" class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="attribid" value=""/>
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
                        
                        <div class="form-group{{ $errors->has('screenname') ? ' has-error' : '' }}">
                            <label for="screenname" class="col-md-4 control-label">Screen Name</label>

                            <div class="col-md-6">
                                <input id="screenname" type="text" class="form-control" name="screenname" value="{{ old('screenname') }}" required autofocus>

                                @if ($errors->has('screenname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('screenname') }}</strong>
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

                        <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                            <label for="unit" class="col-md-4 control-label">Unit</label>

                            <div class="col-md-6">
                                <input id="unit" type="text" class="form-control" name="unit" value="{{ old('unit') }}" required autofocus>

                                @if ($errors->has('unit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                                <select name="type" id="type" class="form-select" required>
                                    <option value='string'>string</option>
                                    <option value='text'>textarea</option>
                                    <option value='date'>date</option>
                                    <option value='yesno'>yes/no</option>
                                    <option value='checkbox'>multipleselect</option>
                                    <option value='dropdown'>dropdown</option>
                                    <option value='number'>number</option>
                                </select>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('values') ? ' has-error' : '' }}">
                            <label for="values" class="col-md-4 control-label">Values</label>

                            <div class="col-md-6">
                                <input id="values" type="text" class="form-control" name="values" value="{{ old('values') }}" required autofocus>

                                @if ($errors->has('values'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('values') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('attgroup') ? ' has-error' : '' }}">
                            <label for="attgroup" class="col-md-4 control-label">Group</label>

                            <div class="col-md-6">
                                <input id="attgroup" type="text" class="form-control" name="attgroup" value="{{ old('attgroup') }}" required autofocus>

                                @if ($errors->has('attgroup'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attgroup') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
                        <div class="form-group">
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
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <table class="table table-hover" style="border:1px solid #ccc">
                <thead>
                    <tr style="background-color:#ffcc99;color:#cc6600;">
                        <th>Attribute Name</th>
                        <th>Screen Name</th>
                        <th>Content</th>
                        <th>Unit</th>
                        <th>Type</th>
                        <th>Values</th>
                        <th>Group</th>
                        <th>Action</th>
                    </tr>
                </thead>
        @foreach($attributes as $attrib) 
                <tbody>  
                    <tr>
                        <td class="namecontainer">{{ $attrib["name"] }}</td>
                        <td class="screennamecontainer">{{ $attrib["screenname"] }}</td>
                        <td class="contentcontainer">{{ $attrib["content"] }}</td>
                        <td class="unitcontainer">{{ $attrib["unit"] }}</td>
                        <td class="typecontainer">{{ $attrib["type"] }}</td>
                        <td class="valuescontainer">{{ $attrib["values"] }}</td>
                        <td class="groupcontainer">{{ $attrib["attgroup"] }}</td>
                        <td class="actioncontainer"><button class="btn btn-warning btn-xs btn-detail editbtn" value="{{$attrib->id}}">Edit</button>
                            <button class="btn btn-danger btn-xs btn-detail deletebtn" value="{{$attrib->id}}">Delete</button>
                        </td>
                    </tr>
        @endforeach
        </tbody>
        </table>
        {{$attributes->links()}}
    
@endsection


@section('scripts')
<script>
$(document).ready(function(){
	
	var url = "{{URL::to('/')}}";
    
    // attributeForm start
    $("#attributeform").hide();
    //closeformbtn
    $("#closeformbtn").click(function(){
        $("#attributeform").hide(400);
        clearform();
    });
    
    $("#createAttribute").click(function(){
        $("#attributeform").toggle(400);
         $("#updatebtn").hide(); 
        $("#addbtn").show();
        clearform();
    });
    // attributeForm end
    
    
	//delete start
	$(".actioncontainer").on("click",".deletebtn",function(){
		//alert(url + '/admin/attribute/' + $(this).val());
		$.ajax({

            type: "DELETE",
            url: url + '/admin/attribute/' + $(this).val(),
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
        $.ajax({
            type: "POST",
            url: url + '/admin/attribute',
			data:{
				name:$("#name").val(),
				screenname:$("#screenname").val(),
				content:$("#content").val(),
				unit:$("#unit").val(),
                type:$("#type").val(),
				values:$("#values").val(),
				attgroup:$("#attgroup").val(),
			},
            success: function (data) {
                
                Swal.fire(data).then(()=>location.reload())
                // alert(data);
                //location.reload();

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
        
        $("#attributeform").show(400);
        $("#addbtn").hide();
        $("#updatebtn").show();
        //
        $.ajax({
            type: "GET",
            url: url + '/admin/attribute/'+$(this).val()+'/edit',
			success: function (data) {
                $("#attribid").val(data.id);
                $("#name").val(data.name);
				$("#screenname").val(data.screenname);
                $("#content").val(data.content);               
                $("#unit").val(data.unit);
                $("#type").val(data.type);               
                $("#values").val(data.values);
				$("#attgroup").val(data.attgroup);
               // console.log(data.name);
                
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
            url: url + '/admin/attribute/'+$("#attribid").val(),
            data:{
				name:$("#name").val(),
				screenname:$("#screenname").val(),
				content:$("#content").val(),
				unit:$("#unit").val(),
                type:$("#type").val(),
				values:$("#values").val(),
				attgroup:$("#attgroup").val(),
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
});
</script>
@endsection