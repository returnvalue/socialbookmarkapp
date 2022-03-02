@extends('layouts.master')

@section('content')
    <div class="col-md-12">
        {!! Form::open(['method' => 'PUT', 'route' => ['link.update',$link->slug], 'class' => 'form', 'novalidate' => 'novalidate']) !!}
        <a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>

        <h2>Submit a Link
            <small>Submissions *must* fit into one of the offered categories. All are free to submit resources, however
                the moderators will delete any links not meeting a high level of quality, with good content, correct
                spelling, and proper formatting. Of course, any spam will be deleted immediately.
            </small>
        </h2>
        <div style="padding-bottom:20px" class="clearfix"></div>


        @if (count($errors) > 0)
            <div class="alert alert-danger">
                There were some problems with your input.<br/>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            {!! Form::label('Link Name') !!}
            {!! Form::text('name', $link->name, array('required', 'class'=>'form-control input-lg', 'placeholder'=>'Link Name')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Link URL') !!}
            {!! Form::text('url', $link->url, array('required', 'class'=>'form-control input-lg',
            'placeholder'=>'http://...')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Link Category') !!}<br/>
            {!! Form::select('category', (['0' => 'Select a Category'] + $categories), $link->category->id, ['class' => 'form-control
            input-lg']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Description (Markup not supported)') !!}<span id="characters_remaining"
                                                                           class="pull-right"></span><br/>
            {!! Form::textarea('description', $link->description, ['size' => '100x3', 'id' => 'link-description', 'class' =>
            'form-control input-lg', 'maxlength' => '300']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tags', 'Select associated tags (hold ctrl for multiple):') !!}
            {!! Form::select('tags[]', $tags, $currentTags, ['class' => 'form-control input-lg', 'multiple', 'id' => 'prettify']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update Link!', array('class'=>'btn btn-success')) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endsection
