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
        	<div class="container" id="app">
        		<div class="title">
        			<p>1.1.2.16</p>
        			<p>Disciplinary Action Information</p>
        		</div>
        		<div class="table">
        			<table>
					  <tr>
					    <th>Employee Code</th>
					    <th></th>
					    <th><autocomplete></autocomplete></th>
					    <th></th>
					  </tr>
					  <tr>
					    <td>Name</td>
					    <td></td>
					    <td>Rnk</td>
					    <td></td>
					  </tr>
					  <tr>
					    <td>Designation</td>
					    <td></td>
					    <td>Organization</td>
					    <td></td>
					  </tr>
					  <tr>
					    <td>Location</td>
					    <td></td>
					    <td>SPDS</td>
					    <td>LPDS</td>
					  </tr>
					  <tr>
					  	<td style="border: unset;">
						  	<div style="height: 90px; width: 90px; border: 1px solid #ddd; margin-bottom: 10px;">
			                  <img src="#" style="width: 100%; height: 100%;">
			                </div>
		                </td>
					  </tr>
					</table>
        		</div>

        		<div class="form-title">
        			@if(!isset($employee_info->id))
        				<p>Add New Disciplinary Action</p>
        			@elseif(isset($employee_info_edit->id))
	                	<p>Edit Disciplinary Action</p>
	                @else
	                	<p>View Disciplinary Action</p>
	                @endif
        		</div>

        		@if(!isset($employee_info_edit->id))
        		<form action="{{route('employee.store')}}" method="POST" class="e-form">
        		@else
        		<form action="{{route('employee.update',$employee_info_edit->id)}}" method="POST" class="e-form">
        			<input type="hidden" name="_method" value="put">
        		@endif
        			@csrf
				  <div class="row">
				    <div class="col-25">
				      <label for="date">Go Date</label>
				    </div>
				    <div class="col-75">
				      <input type="date" id="date" name="date" value="{{old('date',$employee_info->date,$employee_info_edit->date)}}">
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="employee_code">Employee Code</label>
				    </div>
				    <div class="col-75">
				      <select id="employee_code" name="employee_code">
				      	<option>Select</option>
				      	@foreach($employers as $e_info)
				        <option value="{{$e_info->id}}" @if(old('employee_code',$employee_info->employee_code,$employee_info_edit->employee_code) == $e_info->id) {{'selected'}} @endif>{{$e_info->name}}</option>
				        @endforeach
				      </select>
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="offence">Offence</label>
				    </div>
				    <div class="col-75">
				      <select id="offence" name="offence">
				        <option value="combobox" @if(old('offence',$employee_info->offence,$employee_info_edit->offence) == 'combobox') {{'selected'}} @endif>Combobox</option>
				      </select>
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="punishment">Nature of Punishment</label>
				    </div>
				    <div class="col-75">
				      <select id="punishment" name="punishment">
				        <option value="combobox"  @if(old('punishment',$employee_info->punishment,$employee_info_edit->punishment) == 'combobox') {{'selected'}} @endif>Combobox</option>
				      </select>
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="punishment_line1">Punishment Line 1</label>
				    </div>
				    <div class="col-75">
				      <input type="text" id="punishment_line1" name="punishment_line1" value="{{old('punishment_line1',$employee_info->punishment_line1,$employee_info_edit->punishment_line1)}}">
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="punishment_line2">Punishment Line 2</label>
				    </div>
				    <div class="col-75">
				      <input type="text" id="punishment_line2" name="punishment_line2" value="{{old('punishment_line2',$employee_info->punishment_line2,$employee_info_edit->punishment_line2)}}">
				    </div>
				  </div>
				  <div class="row">
				    <div class="col-25">
				      <label for="remarks">Remarks</label>
				    </div>
				    <div class="col-75">
				      <input type="text" id="remarks" name="remarks" value="{{old('remarks',$employee_info->remarks,$employee_info_edit->remarks)}}">
				    </div>
				  </div>
				  @if(!isset($employee_info->id))
				  <div class="row">
				    <input type="submit" value="Save & Process">
				  </div>
				  @elseif(isset($employee_info_edit->id))
				  	<div class="row">
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
					    <td>Go Date</td>
					    <td>Offence</td>
					    <td>Nature of punishment</td>
					    <td>Action</td>
					  </tr>
					  @foreach($employees as $employee)
					  <tr>
					    <td>{{$employee->date}}</td>
					    <td>{{$employee->offence}}</td>
					    <td>
					    	{{$employee->punishment}}
					    	@if($employee->punishment_line1)
					    		<br>{{$employee->punishment_line1}}
					    	@endif
					    	@if($employee->punishment_line2)
					    		<br>{{$employee->punishment_line2}}
					    	@endif
					    </td>
					    <td>
					    	<a href="{{route('employee.show',$employee->id)}}">View</a> ||
					    	<a href="{{route('employee.edit',$employee->id)}}">Edit</a> ||
					    	<form action="{{route('employee.destroy',$employee->id)}}" onclick="return confirm('Are you sure to delete this item?')" method="POST" style="display: inline-block;border: unset;padding: unset;">
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


	<script type="text/javascript">
	    Vue.component('autocomplete', {
	      template: '<div><input type="text" v-model="searchquery" v-on:keyup="autoComplete" class="form-control"><div class="panel-footer" v-if="data_results.length"><ul class="list-group"><li class="list-group-item" v-for="result in data_results">@{{ result.name }}</li></ul></div></div>',
	      data: function () {
	        return {
	          searchquery: '',
	          data_results: []
	        }
	      },
	      methods: {
	        autoComplete(){
	        this.data_results = [];
	        if(this.searchquery.length > 2){
	         axios.get('/vuejs/autocomplete/search',{params: {searchquery: this.searchquery}}).then(response => {
	            console.log(response);
	          this.data_results = response.data;
	         });
	        }

	       }

	      },

	    })


	    const app = new Vue({
	        el: '#app'
	    });
		</script>
    </body>
</html>
