@extends('layouts.master')
    
@section('content')

<h1>Categories</h1>

	@if ($categories->count() > 0)
	<table class="table borderless">
  @foreach ($categories as $category)
    <tr>
    <td class="col-md-12">
      <strong><a href="{{ URL::Route('category.show', array('id' => $category->slug)) }}">{{ $category->name }}</a></strong>
    </td>
    </tr>
  @endforeach
  </table>
  @else
    <p>
    No categories available.
    </p>
  @endif

@endsection