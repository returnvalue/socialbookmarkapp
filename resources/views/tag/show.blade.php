@extends('layouts.master')

@section('content')

    <a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>
    <table>
        <tr>
            <td><h1 class="animated flipInX">{{ $links->total() }} awesome {{ $tag->name }}</h1></td>
            <td style="vertical-align: bottom; padding: 4px;">
                <h4 class="text-muted animated lightSpeedIn"> resources </h4></td>
            <td style="vertical-align: bottom; padding: 4px;">
                <div class="addthis_sharing_toolbox"></div>
            </td>
        </tr>
    </table>

    <div style="padding-bottom:20px" class="clearfix"></div>

    @if ($links->count() > 0)

        @include('partials.linktable', array('categories' => $categories, 'links' => $links))

    @else
        <p>
            No links available.
        </p>

        <p>
            @if(Auth::check())
                <a href="{{ URL::Route('link.create') }}">Submit a link</a>
            @else
                If you were signed in you could add a link to this category. <a href="/auth/login">Sign In</a> or
                <a href="/auth/register">Create an account</a>.
            @endif
        </p>
    @endif

    {!! $links->render() !!}


@endsection