@extends('layouts.app')
@section('content')


<div id="auth">
    <div class="auth-card auth-card-small">

        <div class="card-title">
            <h1>{{ __('Sign Up') }}</h1>
        </div>

        <div class="content">
            <form action="{{ route('register.store.one') }}" method="POST">
                @csrf
                <input id="auth-firstname" type="text" placeholder="{{ __('Firstname') }}"
                    class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname"
                    value="{{ old('firstname') }}" required autofocus>
                @if ($errors->has('firstname'))
                <span class="help is-danger" role="alert">
                    {{ $errors->first('firstname') }}
                </span>
                @endif

                <input id="auth-lastname" type="text" placeholder="{{ __('Lastname') }}"
                    class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname"
                    value="{{ old('lastname') }}" required autofocus>
                @if ($errors->has('lastname'))
                <span class="help is-danger" role="alert">
                    {{ $errors->first('lastname') }}
                </span>
                @endif


                <input id="auth-email" type="email" placeholder="{{ __('E-Mail Address') }}"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                    value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="help is-danger" role="alert">
                    {{ $errors->first('email') }}
                </span>
                @endif

                <button type="submit" class="btn btn-primary" value="{{ __('Next') }}">{{ __('Next') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection