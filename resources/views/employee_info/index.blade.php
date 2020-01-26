<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" >

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    </head>
    <body>
        <div class="inner-container">
        	<div class="header">
        		<a href="{{url('/')}}">Home</a>
        		<a href="{{route('employee-info.index')}}">Employee Info</a>
        		<a href="{{route('employee.index')}}">Employee</a>
        	</div>
        	<div class="container">

        		<div class="form-title">
        			@if(!isset($employee_info->id))
        				<p>Add New Employee</p>
        			@elseif(isset($employee_info_edit->id))
	                	<p>Edit</p>
	                @else
	                	<p>View</p>
	                @endif
        		</div>

        		@if(!isset($employee_info_edit->id))
        		<form action="{{route('employee-info.store')}}" method="POST" class="e-form" enctype="multipart/form-data">
        		@else
        		<form action="{{route('employee-info.update',$employee_info_edit->id)}}" method="POST" class="e-form" enctype="multipart/form-data">
        			<input type="hidden" name="_method" value="put">
        		@endif
        			@csrf
				  <div class="row">
				    <div class="col-25">
				      <label for="name">Employee Name</label>
				    </div>
				    <div class="col-75">
				      <input type="text" id="name" name="name" value="{{old('name',$employee_info->name,$employee_info_edit->name)}}">
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="rank">Rank</label>
				    </div>
				    <div class="col-75">
				      <input type="text" id="rank" name="rank" value="{{old('rank',$employee_info->rank,$employee_info_edit->rank)}}">
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="designation">Designation</label>
				    </div>
				    <div class="col-75">
				      <input type="text" id="designation" name="designation" value="{{old('designation',$employee_info->designation,$employee_info_edit->designation)}}">
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="organization">Organization</label>
				    </div>
				    <div class="col-75">
				      <input type="text" id="organization" name="organization" value="{{old('organization',$employee_info->organization,$employee_info_edit->organization)}}">
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="location">Location</label>
				    </div>
				    <div class="col-75">
				      <input type="text" id="location" name="location" value="{{old('location',$employee_info->location,$employee_info_edit->location)}}">
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="photos">Image</label>
				    </div>
				    <div class="col-75">
				      <div style="height: 90px; width: 90px; border: 1px solid #ddd; margin-bottom: 10px;">
		                  <img src="#" alt="Upload image" id="img" style="width: 100%; height: 100%;">
		                </div>
		                <input type="file" name="photos" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
		              </div>
				    </div>
				  </div>
				  @if(!isset($employee_info->id))
				  <div class="row e-form">
				    <input type="submit" value="Save & Process">
				  </div>
				  @elseif(isset($employee_info_edit->id))
				  	<div class="row e-form">
					    <input type="submit" value="Update">
					</div>
	              @endif
				</form>
				<div class="table">
        			<table>
					  <tr>
					    <th>List of Disciplinary Action</th>
					    <th></th>
					    <th></th>
					    <th></th>
					  </tr>
					  <tr>
					    <td>Name</td>
					    <td>Rank</td>
					    <td>Designation</td>
					    <td>Action</td>
					  </tr>
					  @foreach($employees as $employee)
					  <tr>
					    <td>{{$employee->name}}</td>
					    <td>{{$employee->rank}}</td>
					    <td>{{$employee->designation}}</td>
					    <td>
					    	<a href="{{route('employee-info.show',$employee->id)}}">View</a> ||
					    	<a href="{{route('employee-info.edit',$employee->id)}}">Edit</a> ||
					    	<form action="{{route('employee-info.destroy',$employee->id)}}" onclick="return confirm('Are you sure to delete this item?')" method="POST" style="display: inline-block;border: unset;padding: unset;">
	                          <input type="hidden" name="_method" value="DELETE">
	                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                          <input type="submit" value="Delete" style="border: unset;background-color: unset;">
	                        </form>
					    </td>
					  </tr>
					  @endforeach
					</table>
        		</div>
        	</div>
        </div>
    </body>
</html>
