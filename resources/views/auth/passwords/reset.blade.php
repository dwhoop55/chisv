@extends('layouts.auth')

@section('content')
<div class="columns is-centered">
    <div class="column is-half">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title is-block has-text-centered">
                    Set Password
                </p>
            </header>
            <div class="card-content">

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">


                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                                class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email"
                                value="{{ old('email') }}" required autofocus>
                            <span class="icon is-small is-left">
                                <i class="icon mdi mdi-at"></i>
                            </span>
                        </div>
                        @if ($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>


                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input id="password" type="password" placeholder="{{ __('Password') }}"
                                class="input {{ $errors->has('password') ? 'is-danger' : '' }}" name="password" required
                                autofocus>
                            <span class="icon is-small is-left">
                                <i class="icon mdi mdi-at"></i>
                            </span>
                        </div>
                        @if ($errors->has('password'))
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>


                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}"
                                class="input {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}"
                                name="password_confirmation" required autofocus>
                            <span class="icon is-small is-left">
                                <i class="icon mdi mdi-at"></i>
                            </span>
                        </div>
                    </div>



                    <button type="submit" class="button is-primary">
                        {{ __('Reset Password') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection