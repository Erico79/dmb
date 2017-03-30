@extends('layouts.login-layout')
@section('title', 'Login Page')

@section('content')
    <!-- BEGIN LOGIN FORM -->
    <form id="loginform" class="form-vertical no-padding no-margin" action="{{ url('/login') }}" method="POST">
        {{ csrf_field() }}
        <p class="center">Enter your username and password.</p>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i></span><input id="input-username" type="text" placeholder="Email" id="email" value="{{ old('email') }}" name="email" required autofocus/>
                </div>
                @if($errors->has('email'))
                    <span class="help-block" style="color: red;">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-lock"></i></span><input id="input-password" type="password" placeholder="Password" name="password" id="password" required/>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block" style="color: red;">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="control-group remember-me">
            <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="remember" value="1"/> Remember me
                </label>
                <a href="javascript:;" class="pull-right" id="forget-password">Forgot Password?</a>
            </div>
        </div>
        <input type="submit" id="login-btn" class="btn btn-block btn-inverse" value="Login" />
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form id="forgotform" class="form-vertical no-padding no-margin hide" action="index.html">
        <p class="center">Enter your e-mail address below to reset your password.</p>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-envelope"></i></span><input id="input-email" type="text" placeholder="Email" />
                </div>
            </div>
            <div class="space10"></div>
        </div>
        <input type="button" id="forget-btn" class="btn btn-block btn-inverse" value="Submit" />
    </form>
    <!-- END FORGOT PASSWORD FORM -->
@endsection