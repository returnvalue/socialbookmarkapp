@extends('layouts.master')

@section('content')
<h1>Reset Password</h1>

@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif

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

<form class="form col-md-6" role="form" method="POST" action="{{ url('/password/email') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label class="control-label">E-Mail Address</label>
		<div>
			<input type="email" class="form-control" name="email" value="{{ old('email') }}">
		</div>
	</div>

	<div class="form-group">
		<div>
			<button type="submit" class="btn btn-success">
				Send Password Reset Link
			</button>
		</div>
	</div>
</form>
@endsection
