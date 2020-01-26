@extends('welcome')

@section('content')
<div class="register">
	<h2>Register Form</h2>

	<form action="{{route('register')}}" method="post">
		@csrf
	  <div class="container">
	  	<label for="name"><b>Name</b></label>
	    <input type="text" placeholder="" name="name" required>

	    <label for="email"><b>Email</b></label>
	    <input type="email" placeholder="" name="email" required>

	    <label for="password"><b>Password</b></label>
	    <input type="password" name="password" required>
	        
	    <button type="submit">Login</button>
	    <label>
	        <input type="checkbox" checked="checked" name="remember"> Remember me
	    	<span class="password">Forgot <a href="#">password?</a></span>
	    </label>
	  </div>
	</form>
</div>
@endsection