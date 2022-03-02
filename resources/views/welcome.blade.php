@extends('layouts.master')

@section('content')



    <div style="padding-bottom:20px" class="clearfix"></div>


    @if ($links->count() > 0)



        @include('partials.linktable', ['category' => $category, 'categories' => $categories, 'links' => $links] )

        {!! $links->render() !!}

    @else

        <p>
            No links available.
        </p>

    @endif

@endsection