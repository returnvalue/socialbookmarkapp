<?php

<div style="margin-left: 22px">
    @if ($categories != '' and isset($query) == null and isset($tag) == null )
        {!! Form::open(array('url' => Route::currentRouteName() == 'welcome' || Route::currentRouteName() ==
        'category.show'  ? '/category/' : route(Route::currentRouteName()),
        'method' => 'get', 'id' => 'filter-form',
        'class' => 'form-horizontal',
        'novalidate' => 'novalidate')) !!}
        <div class="form-group">
            <div class="col-sm-3" style="padding-left: 0px;">
                {!! Form::select('category', array_merge(['0' => 'Filter by Category'], $categories), $category,
                ['class' => 'form-control', 'id' => 'category-box']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    @endif
</div>