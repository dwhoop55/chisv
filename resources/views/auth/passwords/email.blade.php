@extends('layouts.auth')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="columns is-centered">
    <div class="column is-one-third">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title is-block has-text-centered">
                    Reset Password
                </p>
            </header>
            <div class="card-content">

                <div class="login-form">
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf

                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                                    class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email"
                                    value="{{ old('email') }}" required autofocus>
                                <i class="icon mdi mdi-at"></i>
                            </div>
                            @if ($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <button type="submit" class="button is-primary">Send Password Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection