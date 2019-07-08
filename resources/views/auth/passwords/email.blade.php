@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="columns is-centered">
    <div class="column is-half">
        <div class="form-card">
            <div class="form-title">
                <h1>Reset Password</h1>
            </div>
            <div class="form-content">
                <div class="card-body">

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
</div>
@endsection