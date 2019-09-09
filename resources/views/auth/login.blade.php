@extends('layouts.auth')

@section('content')
<div class="columns is-centered">
    <div class="column is-half">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title is-block has-text-centered">
                    Sign in to chisv
                </p>
            </header>
            <div class="card-content">

                <div class="field">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input id="email" type="email" placeholder="E-Mail Address"
                                    class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email"
                                    value="{{ old('email') }}" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="mdi mdi-at"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control has-icons-left">
                                <input id="password" placeholder="{{ __('Password') }}" type="password"
                                    class="input {{ $errors->has('password') ? 'is-danger' : '' }}" name="password"
                                    required>
                                <span class="icon is-small is-left">
                                    <i class="mdi mdi-key"></i>
                                </span>
                            </div>
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
                        <div class="field">
                            <a href="{{ route('register.show') }}">No Account? Sign up</a>
                        </div>
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <button type="submit" class="button is-primary">
                                    Login
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection