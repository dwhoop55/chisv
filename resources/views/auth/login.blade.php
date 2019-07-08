@extends('layouts.app')

@section('content')

<div class="columns is-centered">
    <div class="column is-half">
        <div class="form-card">
            <div class="form-title">
                <h1>Sign In</h1>
            </div>
            <div class="form-content">

                <div class="field">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                                    class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email"
                                    value="{{ old('email') }}" required autofocus>
                                <i class="icon mdi mdi-at"></i>
                            </p>
                        </div>

                        <div class="field">
                            <p class="control has-icons-left">
                                <input id="password" placeholder="{{ __('Password') }}" type="password"
                                    class="input {{ $errors->has('password') ? 'is-danger' : '' }}" name="password"
                                    required>
                                <i class="icon mdi mdi-key"></i>
                            </p>
                        </div>

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

                        <div class="field">
                            <div class="field">
                                <div class="control">
                                    <label id="remember" class="checkbox">
                                        <input type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="field">
                            <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>

                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <button type="submit" class="button is-primary">
                                    Login
                                </button>
                            </p>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection