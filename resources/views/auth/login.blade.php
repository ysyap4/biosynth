@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: transparent;">
                <div class="panel-heading" style="opacity: 0.6;">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('s_email') ? ' has-error' : '' }}">
                            <label for="s_email" class="col-md-4 control-label" style="color: white;">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="s_email" type="email" class="form-control" name="s_email" value="{{ old('s_email') }}" required autofocus style="opacity: 0.6; color: black;">

                                @if ($errors->has('s_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('s_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label" style="color: white;">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required style="opacity: 0.6; color: black;">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="background-color: transparent; border-color: white;">
                                    Login
                                </button>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
