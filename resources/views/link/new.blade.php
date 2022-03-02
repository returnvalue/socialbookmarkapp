@extends('layouts.master')
    
@section('content')

<a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>

<table>
    <tr>
        <td><h1 class="animated flipInX">The Latest Links</h1></td>
        <td style="vertical-align: bottom; padding: 4px;"><h4 class="text-muted animated lightSpeedIn">Recently added resources.</h4> </td>
    </tr>
</table>

<div style="padding-bottom:20px" class="clearfix"></div>

	@if ($links->count() > 0)
        @include('partials.linktable', array('category' => $category, 'categories' => $categories, 'links' => $links))
	@else
	    <p>
	    No links available.
	    </p>
  	@endif

{!! $links->render() !!}

@endsection