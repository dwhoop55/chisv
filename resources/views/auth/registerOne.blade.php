@extends('layouts.app')
@section('content')

<div class="login-form">
    <form action="{{ route('registerOne') }}" method="POST">
        @csrf
        <div class="col" <div class="form-group">
            <input id="firstname" type="name" placeholder="{{ __('Firstname') }}"
                class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname"
                value="{{ old('firstname') }}" required autofocus>
            @if ($errors->has('firstname'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('firstname') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <input id="lastname" type="name" placeholder="{{ __('Lastname') }}"
                class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname"
                value="{{ old('lastname') }}" required autofocus>
            @if ($errors->has('lastname'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('lastname') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        {{-- <div class="form-group">
            <input id="password" placeholder="{{ __('Password') }}" type="password"
        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span> @endif
</div>

<div class="form-group">
    <input id="password-confirm" placeholder="{{ __('Confirm Password') }}" type="password"
        class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" name="password_confirmation"
        required>
    @if ($errors->has('password-confirm'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('password-confirm') }}</strong>
    </span>
    @endif
</div> --}}

<input type="submit" class="btn btn-primary btn-block btn-lg" value="{{ __('Next') }}">
</form>
</div>
@endsection