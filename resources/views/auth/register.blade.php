@extends('layouts.master')

@section('content')
    <a href="/"><img class="img-circle" height="80px" align="left" style="margin-right:10px" src="/images/105logo.png"></a>

    <table>
        <tr>
            <td><h1 class="animated flipInX">Create Your Account</h1></td>
            <td style="vertical-align: bottom; padding: 4px;">
                <h4 class="text-muted animated lightSpeedIn">Join the community today.</h4></td>
        </tr>
    </table>

    <div style="padding-bottom:20px" class="clearfix"></div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p class="lead">
        Fill out the form below to get started.
    </p>

    <form class="form col-md-8" role="form" method="POST" action="{{ url('/auth/register') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="control-label">Username</label>
            <div>
                <input type="text" class="form-control input-lg" name="name" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">E-Mail Address <em>(We will never email you - this is only to create your account)</em></label>
            <div>
                <input type="email" class="form-control input-lg" name="email" value="{{ old('email') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Password</label>
            <div>
                <input type="password" class="form-control input-lg" name="password">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Confirm Password</label>
            <div>
                <input type="password" class="form-control input-lg" name="password_confirmation">
            </div>
        </div>

        <div class="form-group">
            <div>
                <button type="submit" class="btn btn-success">
                    Register
                </button>
            </div>
        </div>
        {!! Recaptcha::render() !!}
    </form>

@endsection
