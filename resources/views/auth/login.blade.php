@extends('layouts.app')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <b>Login</b> to Dashboard</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login') }}" method="POST">
        @csrf

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Email">

        @if ($errors->has('email'))
            <span class="invalid-feedback" style="color: red;" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password">

        @if ($errors->has('password'))
            <span class="invalid-feedback" style="color: red;" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

        <span class="fa fa-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" value="{{ old('remember') }}"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br>
    <a href="{{ route('password.request') }}">I forgot my password</a><br>

  </div>
</div>
@endsection
