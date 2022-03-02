@extends('layouts.master')

@section('content')
    <div class="col-md-12">
        {!! Form::open(array('route' => 'link.store', 'class' => 'form', 'novalidate' => 'novalidate')) !!}
        <a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>

        <h2>Submit a Resource
            <small>Submissions *must* fit into one of the offered categories. All are free to submit Resources, however
                the moderators will delete any Resources not meeting a high level of quality, with good content, correct
                spelling, and proper formatting. Of course, any spam will be deleted immediately.
            </small>
            <hr>
        </h2>
        <hr>
        <h4>What Makes A Great Resource?</h4>
        <p>There are lots of things that make for a great resource. You're on the right track if you're about to submit something like:
        <ul>
            <li>A Tutorial that helped you with something tricky...</li>
            <li>A Development blog post that helped you...</li>
            <li>A Framework that helped you solve a challenging problem...</li>
            <li>A tool that made your Workflow more efficient...</li>
            <li>A List of other curated development resources...</li>
            <li>A great Theme, Template, or Plugin...</li>
            <li>A fantastic demo of HTML, CSS, and JavaScript markup <small>(codepen, jsbin, jsfiddle, etc...)</small></li>
            <li>Anything that has helped you be a better Web Developer...</li>
        </ul>
        </p>
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

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('Resource Name') !!}
            {!! Form::text('name', null, ['required', 'class'=>'form-control input-lg', 'placeholder'=>'Resource Name', 'id' => 'resourcename']) !!}
        </div>

        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            {!! Form::label('Resource URL') !!}
            {!! Form::text('url', null, ['required', 'class'=>'form-control input-lg',
            'placeholder'=>'http://...', 'id' => 'resourceurl']) !!}
        </div>

        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
            {!! Form::label('Resource Category') !!}<br/>
            {!! Form::select('category', (['0' => 'Select a Category'] + $categories), null, ['class' => 'form-control
            input-lg']) !!}
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            {!! Form::label('Description: Tell us a little bit about what makes this resource awesome') !!}<span id="characters_remaining"
                                                                           class="pull-right"></span><br/>
            {!! Form::textarea('description', null, ['size' => '100x3', 'id' => 'link-description', 'class' =>
            'form-control input-lg', 'maxlength' => '1000', 'id' => 'resourcedescription']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tags', 'Choose at least one tag') !!}
            {!! Form::select('tags[]', $tags, null, ['class' => 'form-control input-lg', 'multiple', 'id' => 'prettify', 'data-placeholder' => 'Choose at least one tag']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit Resource!', ['class'=>'btn btn-success']) !!}
        </div>
        {!! Recaptcha::render() !!}
        {!! Form::close() !!}
    </div>

@endsection
