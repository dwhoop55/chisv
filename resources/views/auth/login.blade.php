@extends('layouts.app')

@section('content')
<div id="auth">
    <div class="auth-card auth-card-small">

        <div class="card-title">
            <h1>Please Sign In</h1>
        </div>

        <div class="content">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                    value="{{ old('email') }}" required autofocus>
                <input id="password" placeholder="{{ __('Password') }}" type="password"
                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('email'))
                <span class="help is-danger" role="alert">
                    {{ $errors->first('email') }}
                </span>
                @endif
                @if ($errors->has('password'))
                <span class="help is-danger" role="alert">
                    {{ $errors->first('password') }}
                </span>
                @endif

                <div class="level options">
                    <label class="checkbox-inline"><input class="regular-checkbox" type="checkbox" name="remember"
                            id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}</label>

                    <a class="btn btn-link level-right"
                        href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                </div>

                <button type="submit" class="btn btn-primary" value="{{ __('Login') }}">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection