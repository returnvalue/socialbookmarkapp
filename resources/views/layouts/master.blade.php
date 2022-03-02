<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title  or 'Devleaks Best Web Development Resources' }}  </title>
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:image" content="http://devleaks.com/images/105logo.png">
    <meta property="og:title" content="{{$title or 'Devleaks Best Web Development Resources'}}">
    <meta property="og:description" content="{{$metadescription or 'Devleaks Best Web Development Resources'}}">
    <meta property="og:url" content="{{Request::url()}}">
    <meta property="og:site_name" content="{{'Devleaks Best Web Development Resources'}}">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:description" content="{{$metadescription or 'Devleaks Best Web Development Resources'}}">
    <meta name="twitter:title" content="{{$title or 'Devleaks Best Web Development Resources'}}">
    <meta name="twitter:site" content="@devleakslinks">
    <meta name="twitter:domain" content="devleakslinks">

    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="keywords" content="{{ $metakeywords or 'Web Development, Web Design, PHP, JavaScript' }}"/>
    <meta name="description" content="{{ $metadescription or 'The Best Web Development Resources and Lists, all in one place.' }} "/>

    <script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"WebSite","url":"http:\/\/devleaks.com\/","name":"devleaks","potentialAction":{"@type":"SearchAction","target":"http:\/\/devleaks.com\/?s={search_term}","query-input":"required name=search_term"}}</script>
    <script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"Organization","url":"http:\/\/devleaks.com","sameAs":["https:\/\/twitter.com\/devleakslinks"],"name":"devleaks","logo":"http:\/\/devleaks.com\/images\/105logo.png"}</script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/animate.css/3.3.0/animate.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/app.css">

    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="/js/application.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ff0eec21a977f85" async="async"></script>
    <script type="text/javascript">
        var addthis_config = {
            data_track_clickback: false
        }
    </script>

    <style>
        .twittershare {
            opacity: 0;
            -webkit-transition: opacity 1s ease-in-out;
            -moz-transition: opacity 1s ease-in-out;
            -ms-transition: opacity 1s ease-in-out;
            -o-transition: opacity 1s ease-in-out;
            transition: opacity 1s ease-in-out;
        }

        .hover:hover .twittershare {
            opacity: 1;
            -webkit-transition: opacity .1s ease-in-out;
            -moz-transition: opacity .1s ease-in-out;
            -ms-transition: opacity .1s ease-in-out;
            -o-transition: opacity .1s ease-in-out;
            transition: opacity .1s ease-in-out;
        }

        .cool:hover {
            background: #f5f5f5;
            transition: all 0.2s ease 0s;
            padding: 0px;
            margin-bottom: 5px;
            min-height: 277px;
        }

        .cool {
            background: white;
            transition: all 0.2s ease 0s;
            padding: 0px;
            margin-bottom: 5px;
            min-height: 277px;
        }

        span.badge {
            font-size: 12px;
            opacity: .7;
        }

        span.badge:hover {
            opacity: 1;
            transition: all 0.2s ease 0s;
        }
    </style>
</head>

<body style="padding-right: 0px; padding-left: 0px;">
<nav class="navbar navbar-default navbar-fixed-top" style="background:#e86d5d; border-bottom: solid #282c2d 10px;" role="navigation"
     style="border-bottom: solid #e86d5d 10px;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/{{session('sortmode')}}">devleaks</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                @if(Auth::check())
                    <li><a href="/user/{{ Auth::user()->name }}">My Favorites</a></li>
                @else
                    <li><a class="loggedout" href="#">My Favorites</a></li>
                @endif

                <li style="font-weight: bold; text-shadow: 0 0 9px yellow"><a href="/link/create">
                        <i class="glyphicon glyphicon-plus"></i>Submit Resource</a></li>
                <?php if (str_contains(\Request::path(), ['tag', 'category', 'new', 'mostclicks', 'mostfavorites']) or \Request::path() == '/') { ?>
                <li class="@if(session()->get('sortmode') == 'new'){{'active'}}@endif">
                    <a href="new"><span class="label label-@if(session()->get('sortmode') == 'new'){{'success'}}@else{{'default'}}@endif"> new</span></a>
                </li>
                <li class="@if(session()->get('sortmode') == 'mostclicks'){{'active'}}@endif">
                    <a href="mostclicks"><span class="label label-@if(session()->get('sortmode') == 'mostclicks'){{'success'}}@else{{'default'}}@endif"> most clicks </span></a>
                </li>
                <li class="@if(session()->get('sortmode') == 'mostfavorites'){{'active'}}@endif">
                    <a href="mostfavorites"><span class="label label-@if(session()->get('sortmode') == 'mostfavorites'){{'success'}}@else{{'default'}}@endif"> most favorites </span></a>
                </li>
                <?php } ?>
            </ul>
            {!! Form::open(['method' => 'GET', 'url' => 'search', 'class' => 'navbar-form navbar-left']) !!}
            <div class="form-group">
                {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
            </div>
            {!! Form::close() !!}
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    @if(Auth::check())
                        <a href="{{ URL::Route('user.show', array('id' => Auth::user()->name)) }}"
                           class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Hi, {{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/{{ Auth::user()->name }}">My Favorites</a></li>
                            <li><a href="/auth/logout">Sign Out</a></li>
                        </ul>
                    @else
                        <a href="/auth/login" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true"
                           aria-expanded="false">Start Here <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/auth/login">Sign In</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/auth/register">Create Account</a></li>
                        </ul>

                    @endif
                </li>

            </ul>
        </div>

    </div>
</nav>

<div class="container" style="min-height: 90%; padding: 20px; background: #ffffff;">

    <?php
    // var_dump(\Request::path());
    //    $value = session()->get('sortmode');
    //    var_dump($value);
    ?>
    @if(Session::has('message'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">

        @yield('content')
    </div>
</div>

</div>
<nav style="background:#e86d5d; border-top: solid #282c2d 10px; margin-bottom:0px; border-radius:0px;"
     class="navbar navbar-default">
    <div class="container">

        <div>
            <ul class="nav navbar-nav navbar-left">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://twitter.com/devleakslinks">Twitter</a></li>
                <li><a href="https://www.facebook.com/devleaks">Facebook</a></li>
                <li><a href="#">&copy; 2015 devleaks</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/terms">Terms</a></li>
            </ul>
        </div>

    </div>
</nav>

<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <p class="lead">Sign in to collect and submit the Best Web Development Resources!</p>

                <div class="lead text-center"><a href="/auth/register">Create Account</a> or <a href="/auth/login">Sign
                        In</a></div>
            </div>
            <div class="modal-footer">
                devleaks
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php  // var_dump(Route::current()) ?>
<script>
    $('a.twittershare').click(function () {

        var width = 818,
            height = 400,
            left = ($(window).width() - width) / 2,
            top = ($(window).height() - height) / 2,
            url = this.href,
            opts = 'status=1' +
                ',width=' + width +
                ',height=' + height +
                ',top=' + top +
                ',left=' + left;

        window.open(url, 'twitter', opts);

        return false;

    });

    $('a.supershare').click(function () {

        var width = 818,
            height = 400,
            left = ($(window).width() - width) / 2,
            top = ($(window).height() - height) / 2,
            url = this.href,
            opts = 'status=1' +
                ',width=' + width +
                ',height=' + height +
                ',top=' + top +
                ',left=' + left;

        window.open(url, 'twitter', opts);

        return false;

    });
</script>

<script type="text/javascript">
    $('#prettify').select2({
        maximumSelectionLength: 3
    });
    $('button[data-loggedout]').click(
        function () {
            $('#modal').modal();
        }
    );
    $('a.loggedout').click(
        function () {
            $('#modal').modal();
        }
    );
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#open').click(function () {
        $('a[data-id]').each(function () {
            window.open($(this).attr('href'));
        });
    });
</script>

<script src="//static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">try {
        clicky.init(100870004);
    } catch (e) {
    }</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100870004ns.gif"/></p></noscript>
</body>
</html>