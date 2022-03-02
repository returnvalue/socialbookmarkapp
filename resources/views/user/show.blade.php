@extends('layouts.master')

@section('content')

    <a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>
    <table>
        <tr>
            <td><h1 class="animated flipInX">{{ $user->name }}</h1></td>
            <td style="vertical-align: bottom; padding: 4px;">
                <h4 class="text-muted animated lightSpeedIn">Recently favorited links by the great {{ $user->name }}.</h4>
            </td>
        </tr>
    </table>

    <div style="padding-bottom:20px" class="clearfix"></div>

    @if ($favoritedLinks->count() > 0)
        @include('partials.linktable', array('category' => $category = '', 'categories' => $categories = '', 'links' => $favoritedLinks))
    @else
        <p>
            No links available.
        </p>
    @endif

    @if ($user->favorites()->count() > 15)

        <p>
            {!! $favoritedLinks->render() !!}
        </p>

    @endif

@endsection