@extends('layouts.master')
    
@section('content')
<a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>

<table>
    <tr>
        <td><h1 class="animated flipInX">Sign In</h1></td>
        <td style="vertical-align: bottom; padding: 4px;"><h4 class="text-muted animated lightSpeedIn">With your top secret credentials.</h4> </td>
    </tr>
</table>
<div style="padding-bottom:20px" class="clearfix"></div>

<p class="lead">
Sign in to collect and submit the Best Web Development Resources. If you're not already a member, registering is free and takes less than 10 seconds. <a href="/auth/register">Register now</a>.
</p>

@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<form class="form col-md-8" role="form" method="POST" action="{{ url('/auth/login') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label class="control-label">E-Mail Address</label>
		<div>
			<input type="email" class="form-control input-lg" name="email" value="{{ old('email') }}">
		</div>
	</div>

	<div class="form-group">
		<label class="control-label">Password</label>
		<div>
			<input type="password" class="form-control input-lg" name="password">
		</div>
	</div>

	<div class="form-group">
		<div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember"> Remember Me
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div>
			<button type="submit" class="btn btn-success">Login</button>

			<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
		</div>
	</div>
</form>
@endsection
