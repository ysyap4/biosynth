@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: transparent;">
                <div class="panel-heading" style="opacity: 0.6;">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('s_name') ? ' has-error' : '' }}">
                            <label for="s_name" class="col-md-4 control-label" style="color: white;">Name</label>

                            <div class="col-md-6">
                                <input id="s_name" type="text" class="form-control" name="s_name" value="{{ old('s_name') }}" required autofocus style="opacity: 0.6; color: black;">

                                @if ($errors->has('s_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('s_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('s_email') ? ' has-error' : '' }}">
                            <label for="s_email" class="col-md-4 control-label" style="color: white;">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="s_email" type="email" class="form-control" name="s_email" value="{{ old('s_email') }}" required style="opacity: 0.6; color: black;">

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
                            <label for="password-confirm" class="col-md-4 control-label" style="color: white;">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required style="opacity: 0.6; color: black;">
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('s_fac') ? ' has-error' : '' }}">
                            <label for="s_fac" class="col-md-4 control-label" style="color: white;">Faculty</label>

                            <div class="col-md-6">
                                <input id="s_fac" type="text" class="form-control" name="s_fac" value="{{ old('s_fac') }}" required autofocus style="opacity: 0.6; color: black;">

                                @if ($errors->has('s_fac'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('s_fac') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('s_matric') ? ' has-error' : '' }}">
                            <label for="s_matric" class="col-md-4 control-label" style="color: white;">Matric</label>

                            <div class="col-md-6">
                                <input id="s_matric" type="text" class="form-control" name="s_matric" value="{{ old('s_matric') }}" required autofocus style="opacity: 0.6; color: black;">

                                @if ($errors->has('s_matric'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('s_matric') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('s_sv') ? ' has-error' : '' }}">
                            <label for="s_sv" class="col-md-4 control-label" style="color: white;">Supervisor</label>

                            <div class="col-md-6">
                                <input id="s_sv" type="text" class="form-control" name="s_sv" value="{{ old('s_sv') }}" required autofocus style="opacity: 0.6; color: black;">

                                @if ($errors->has('s_sv'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('s_sv') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="background-color: transparent; border-color: white;">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
