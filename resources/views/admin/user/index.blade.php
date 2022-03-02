@extends('layouts.master')
    
@section('content')

<h1>Registered Users</h1>

@if ($users->count() > 0)

	<table class="table table-striped">
		<thead>
			<tr>
			<th>Name</th><th>E-mail</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{!! $users->render() !!}

@else

	<p>
	No users registered.
	</p>

@endif

@endsection