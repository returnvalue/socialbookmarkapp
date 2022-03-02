@extends('layouts.master')

@section('content')

    <a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>
    <table>
        <tr>
            <td><h1 class="animated flipInX">All Tags</h1></td>
            <td style="vertical-align: bottom; padding: 4px;">
                <h4 class="text-muted animated lightSpeedIn">for your viewing pleasure.</h4></td>

        </tr>
    </table>

    <div style="padding-bottom:20px" class="clearfix"></div>
    @if ($categories != '' and isset($query) == null  )
        <div style="background:#eae9e9;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);transition: all 0.2s ease 0s; padding:10px; margin:5px; border-radius:10px">
            <ul class="nav nav-pills">
                @foreach ($categories as $slug => $pillcategory)
                    @if(isset($category->slug) and $category->slug == $slug)
                        <li role="presentation" class="active"><a href="/category/{{ $slug }}">{{ $pillcategory }}</a>
                        </li>
                    @else
                        <li role="presentation"><a href="/popular/{{ $slug }}">{{ $pillcategory }}</a></li>
                    @endif
                @endforeach
                @if(!isset($category->slug))
                    <li role="presentation" class="active"><a href="/">All</a></li>
                @else
                    <li role="presentation"><a href="/">All</a></li>
                @endif
            </ul>
        </div>
    @endif


    <div class="alert">
        @if(isset($tags))
            <?php $x = 0  ?>
            @foreach($tags as $tag)
                @if(isset($activetag))
                    @if($activetag == $tag->slug)
                        <a style="text-decoration: none;"
                           href="{{ URL::Route('tag.show', ['id' => $tag->slug]) }}"><span
                                    class="badge" style="background-color: #fa0000;opacity: 1;"> {{ $tag->name }}  </span></a>&nbsp;
                    @else
                        <a style="text-decoration: none;"
                           href="{{ URL::Route('tag.show', ['id' => $tag->slug]) }}"><span
                                    class="badge"> {{ $tag->name }} (<span style="color:yellow;"> {{$tag->tag_count}} </span>) </span></a>&nbsp;
                    @endif
                @else
                    <a style="text-decoration: none;"
                       href="{{ URL::Route('tag.show', ['id' => $tag->slug]) }}"><span
                                class="badge"> {{ $tag->name }} (<span style="color:yellow;"> {{$tag->tag_count}} </span>) </span></a>&nbsp;
                @endif

            @endforeach
        @endif
    </div>

@endsection