@extends('layouts.app')
@section('content')


<div id="auth">
    <div class="auth-card">

        <div class="card-title">
            <h1>{{ __('Search for name or domain of your University') }}</h1>
        </div>

        <div class="content">
            <form action="{{ route('register.store.three') }}" method="POST">
                @csrf
                <input id="auth-search" type="text" placeholder="{{ __('Name or domain') }}"
                    class="{{ $errors->has('search')||$errors->has('noResults') ? ' is-invalid' : '' }}" name="search"
                    value="{{ old('search') }}" required autofocus maxlength=25>
                @if ($errors->has('search'))
                <span class="help is-danger" role="alert">
                    {{ $errors->first('search') }}
                </span>
                @endif
                @if ($errors->has('noResults'))
                <span class="help is-danger" role="alert">
                    {{ __('No results found, try a different term.') }}
                </span>
                @endif

                <button type="submit" class="btn btn-primary" value="{{ __('Search') }}">{{ __('Search') }}</button>
                @if ($errors->has('noResults'))
                <p class="has-text-right is-size-7">{{ __('Your university isn\'t in the list?') }}</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection