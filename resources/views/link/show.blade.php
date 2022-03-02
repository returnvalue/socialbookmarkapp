@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12"><h1 class="animated flipInX">{{$link->name}}</h1></div>
        <div class="col-md-12" style="vertical-align: bottom;">
            <h4 class="text-muted animated lightSpeedIn">{{$link->url}}</h4></div>
    </div>

    <div style="padding-bottom:20px" class="clearfix"></div>
    <?php
    if ($link->category->name == 'JavaScript') {
        $color = '#F0DB4F';
    }
    if ($link->category->name == 'PHP') {
        $color = '#2da9d7';
    }
    if ($link->category->name == 'Tutorials') {
        $color = '#f4364c';
    }
    if ($link->category->name == 'Design') {
        $color = '#2990ea';
    }
    if ($link->category->name == 'Devops') {
        $color = '#52ecc6';
    }
    if ($link->category->name == 'Programming') {
        $color = '#d7af72';
    }
    if ($link->category->name == 'Linux') {
        $color = '#f76f01';
    }
    if ($link->category->name == 'Search') {
        $color = '#028937';
    }
    if ($link->category->name == 'Resources') {
        $color = '#e86d5d';
    }
    if ($link->category->name == 'Tech') {
        $color = '#FFB03B';
    }
    if ($link->category->name == 'Business') {
        $color = '#c90100';
    }
    ?>
    <table class="table borderless hover">
        <tr>
            <td class="col-md-12"
                style="background:white;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);transition: all 0.2s ease 0s; padding:10px; margin:5px;">
                <div style="background:{{$color}};display:block;height:10px;width:100%;"></div>
                <div class="row">
                    <div class="col-md-10">
                        <h1><span style="color:{{$color}};" class="glyphicon glyphicon-link"></span> <a
                                    data-id="{{ $link->id }}" @if(Auth::check()) class="outbound"
                                    @endif href="{{ $link->url}}">{{ $link->name }}</a></h1>

                        <p>
                            Added on: {{ $link->created_at->format('M j H:i') }} by <a
                                    href="{{ URL::Route('user.show', array('id' => $link->user->name)) }}">{{ $link->user->name }}</a>
                        </p>

                        <p class="lead">
                            <img style="margin-bottom: 2px" src="http://www.google.com/s2/favicons?domain={{$link->url}}"/>
                            {{ $link->description }}
                        </p>
                        @unless ($link->tags->isEmpty())
                            <p>
                                @foreach($link->tags as $tag)
                                    <a style="text-decoration: none;"
                                       href="{{ URL::Route('tag.show', ['id' => $tag->slug]) }}"><span
                                                class="label label-danger">{{ $tag->name }}</span></a>
                                @endforeach
                            </p>
                        @endunless
                    </div>
                    @if(Auth::check())
                        @if(Auth::user()->name == 'devleaks')
                            <a href="{{ URL::Route('link.edit', array('id' => $link->slug)) }}">
                                <small class="text-muted">.</small>
                            </a>
                        @endif
                    @endif
                    <div class="col-md-2">
                        <a class="twittershare"
                           href="https://twitter.com/share?url={{ URL::Route('link.show', ['id' => $link->slug]) }}&amp;text={{ $link->description }}"><span
                                    style="color:{{$color}};font-size:40px;margin:30px;"
                                    class="glyphicon glyphicon-share"></span></a>
                    </div>
                </div>

            </td>
        </tr>
    </table>

    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES * * */
        var disqus_shortname = 'devleaks';

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var dsq = document.createElement('script');
            dsq.type = 'text/javascript';
            dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments
            powered by Disqus.</a></noscript>

    @if ($link->users->count() > 0)
        <strong>Recently Favorited By</strong>

        @foreach ($link->users()->orderBy('link_user.created_at', 'desc')->take(15)->get() as $user)

            <p>
                <a href="{{ URL::Route('user.show', array('id' => $user->name)) }}">{{ $user->name }}</a>
            </p>

        @endforeach

    @endif

@endsection