@if ($categories != '' and isset($query) == null  )
    <div style="background:#eae9e9;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);transition: all 0.2s ease 0s; padding:10px; margin:5px; border-radius:10px">
        <ul class="nav nav-pills">
            @foreach ($categories as $slug => $pillcategory)
                @if  (isset($category->slug) and $category->slug == $slug)
                    <li role="presentation" class="active"><a href="/category/{{ $slug }}/{{session('sortmode')}}">{{ $pillcategory }}</a></li>
                @else
                    <li role="presentation"><a href="/category/{{ $slug }}/{{session('sortmode')}}">{{ $pillcategory }}</a></li>
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


<div class="alert" style="margin-bottom: 5px;">
    @if(isset($tags))
        <?php $x = 0  ?>
        @foreach($tags as $tag)
            @if(isset($activetag))
                @if($activetag == $tag->slug)
                    <a style="text-decoration: none;"
                       href="/tag/{{$tag->slug}}/{{session('sortmode')}}"><span
                                class="badge" style="background-color: #fa0000;opacity: 1;"> {{ $tag->name }}  </span></a>&nbsp;
                @else
                    <a style="text-decoration: none;"
                       href="/tag/{{$tag->slug}}/{{session('sortmode')}}"><span
                                class="badge"> {{ $tag->name }} (<span style="color:yellow;"> {{$tag->tag_count}} </span>) </span></a>&nbsp;
                @endif
            @else
                <a style="text-decoration: none;"
                   href="/tag/{{$tag->slug}}/{{session('sortmode')}}"><span
                            class="badge"> {{ $tag->name }} (<span style="color:yellow;"> {{$tag->tag_count}} </span>) </span></a>&nbsp;
            @endif

        @endforeach
        <a style="text-decoration: none;" href="tag/{{session('sortmode')}}"><span class="badge">All</span> </a>
    @endif
</div>

<div class="col-sm-12">
    <div class="row">
        <?php $i = 0  ?>
        @foreach ($links as $link)

            <?php
            if ($link->category->name == 'JavaScript') {
                $color = '#F0DB4F';
                $bgimage = 'javascriptyellow.jpg';
            }
            if ($link->category->name == 'PHP') {
                $color = '#2da9d7';
                $bgimage = 'phpblue.jpg';
            }
            if ($link->category->name == 'Tutorials') {
                $color = '#f4364c';
                $bgimage = 'tutorialsred.jpg';
            }
            if ($link->category->name == 'Design') {
                $color = '#2990ea';
                $bgimage = 'designblue.jpg';
            }
            if ($link->category->name == 'Devops') {
                $color = '#52ecc6';
                $bgimage = 'devopsaqua.jpg';
            }
            if ($link->category->name == 'Programming') {
                $color = '#d7af72';
                $bgimage = 'programmingyellow.jpg';
            }
            if ($link->category->name == 'Linux') {
                $color = '#f76f01';
                $bgimage = 'linuxorange.jpg';
            }
            if ($link->category->name == 'Search') {
                $color = '#028937';
                $bgimage = 'searchgreen.jpg';
            }
            if ($link->category->name == 'Resources') {
                $color = '#e86d5d';
                $bgimage = 'resourcesred.jpg';
            }
            if ($link->category->name == 'Tech') {
                $color = '#FFB03B';
                $bgimage = 'techpurple.jpg';
            }
            if ($link->category->name == 'Business') {
                $color = '#c90100';
                $bgimage = 'businessred.jpg';
            }
            ?>


            <div class="hover col-md-4 cool" @if($i%2 !== 0)style="background:#f9f9f9;"@endif>
                <div style="background:url(http://devleaks.com/images/{{$bgimage}});display:block;height:10px;width:100%;"></div>
                <div class="col-md-12">
                    <span style="color:{{$color}};" class="glyphicon glyphicon-link"></span>
                    <strong><a data-id="{{ $link->id }}" @if(Auth::check()) class="outbound"
                               @endif class="outbound" href="{{ $link->url}}">{{ $link->name }}</a></strong>
                    @if(Auth::check())

                        <span style="float:right; vertical-align: middle; height: 25px;">
                {!! Form::open(array('route' => array('link.favorite'), 'class' => 'favorite form-horizontal')) !!}
                            <input type="hidden" name="id" value="{{ $link->id }}"/>
                            @if (Auth::user()->favorites->contains($link))
                                <button style="text-decoration:none; outline: none;" type="submit" class="btn btn-link fav-btn"
                                        aria-hidden="true">
                                    <span id="star_{{ $link->id }}" class="text-danger lead glyphicon glyphicon-heart"></span>
                                    <span id="lic_{{ $link->id }}">{{ $link->users->count() }}</span>
                                </button>
                            @else
                                <button style="text-decoration:none; outline: none;" type="submit" class="btn btn-link fav-btn"
                                        aria-hidden="true">
                                    <span id="star_{{ $link->id }}" class="text-danger lead glyphicon glyphicon-heart-empty"></span>
                                    <span id="lic_{{ $link->id }}">{{ $link->users->count() }}</span>
                                </button>
                            @endif
                            {!! Form::close() !!}
                 </span>
                    @else
                        <span style="float:right; vertical-align: middle; height: 25px;">
                <button data-toggle="tooltip" data-placement="top" title="Add resource to your collection"
                        style="text-decoration:none; outline: none;" class="btn btn-link fav-btn" data-loggedout aria-hidden="true">
                    <span class="text-danger lead glyphicon glyphicon-heart"></span>
                    <span id="lic_{{ $link->id }}">{{ $link->users->count() }}</span>
                </button>
                </span>
                    @endif
                    <br/>

                    <p>
                        <img style="margin-bottom: 2px" src="http://www.google.com/s2/favicons?domain={{$link->url}}"/> {{ str_limit($link->description, 149, '') }}
                        <a href="{{ URL::Route('link.show', ['id' => $link->slug]) }}">...</a>
                    </p>

                    <div class="col-md-12 text-muted" style="padding-bottom:5px;color:#ccc;">
                        <div>
                            added on {{ $link->created_at->format('M j') }} by <a style="color:#ccc;"
                                                                                  href="{{ URL::Route('user.show', ['id' => $link->user->name]) }}">{{ str_limit($link->user->name, 9, '') }}</a> in
                            <a href="{{ URL::Route('category.show', ['id' => $link->category->slug]) }}">{{ $link->category->name }}</a>
                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top:10px;">
                        @unless ($link->tags->isEmpty())
                            <span style="color:{{$color}};" class="glyphicon glyphicon-tags"></span>&nbsp;
                            @foreach($link->tags as $tag)
                                <a style="text-decoration: none;"
                                   href="/tag/{{$tag->slug}}/{{session('sortmode')}}"><span
                                            class="badge"> {{ $tag->name }}</span></a>&nbsp;
                                @endforeach
                                @endunless
                                        <!--  <small style="color:#ccc;">Clicks: {{ $link->outbound_count }}</small> -->
                                <a class="twittershare pull-right"
                                   href="https://twitter.com/share?url={{ URL::Route('link.show', ['id' => $link->slug]) }}&amp;text={{ $link->description }}"><span
                                            style="color:{{$color}};font-size:30px;"
                                            class="glyphicon glyphicon-share"></span></a>
                    </div>

                </div>
                @if(Auth::check())
                    @if(Auth::user()->name == 'devleaks')
                        <a href="{{ URL::Route('link.edit', ['id' => $link->slug]) }}">
                            <small class="text-muted">e</small>
                        </a>
                        <form action="{{ URL::Route('link.destroy', ['id' => $link->slug]) }}" method="POST">
                            {!! Form::token() !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <button>d</button>
                        </form>
                    @endif
                @endif


            </div>
            <?php $i++  ?>
            @if($i%3 == 0)
    </div>
    <div class="row">
        @endif
        @endforeach
    </div>
</div>

</div>

<div class="row">
    <strong class="text-danger small"><a href="/trending">Trending <span class="glyphicon glyphicon-fire"></span></a></strong>
<span class="small text-muted">
<?php
    for ($i = 0; $i < sizeof($trending); $i++) {
        echo $trending[$i] . ' ';
    }
    ?>
</span>
</div>

<div class="row text-right">
    @if(Auth::check())
        @if(Auth::user()->name == 'devleaks')
            <button id="open" class="btn btn-sm btn-info">
                <small>visit all</small>
            </button>
        @endif
    @endif
</div>
