@extends('layouts.master')

@section('content')
    <a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>
    <table>
        <tr>
            <td><h1 class="animated flipInX">Search Results</h1></td>
            @if($query !== '')
                <td style="vertical-align: bottom; padding: 4px;"><h4 class="text-muted animated lightSpeedIn">For your "{{$query}}" query.</h4></td>
            @endif
        </tr>
    </table>
    <div style="padding-bottom:20px" class="clearfix"></div>

    @if ($links->count() > 0 and $query !== '' )

        @include('partials.linktable', ['category' => $category, 'categories' => $categories, 'links' => $links] )

        {!! $links->render() !!}

    @else
        <p>
            No links available.
        </p>
    @endif



@endsection