@extends('layouts.app')
@section('content')


<div id="auth">
    <div class="auth-card">

        <div class="card-title">
            <h1>{{ __('Choose your University') }}</h1>
        </div>

        <div class="content">
            <form action="{{ route('register.store.two') }}" method="POST">
                @csrf
                @if ($universities->count() > 0)
                <p>
                    @if(session()->get('by') == 'email')
                    Based on your email <strong>{{ $email }}</strong>
                    @else
                    Based on your query <strong>{{ session()->get('search') }}</strong>
                    @endif
                    we found {{ $universities->count() }}
                    @if ($universities->count()== 1)
                    university
                    @else
                    universities
                    @endif</p>
                <div class="control">
                    @foreach ($universities as $university)
                    <div class="field">
                        <label class="radio">
                            <input type="radio" name="university" value="{{ $university->id }}">
                            <strong>{{ $university->shortedUrl }}</strong>
                            {{ $university->name }}
                        </label>
                    </div>
                    @endforeach
                    <div class="field">
                        <label class="radio">
                            <input type="radio" name="university" value="none" checked>
                            {{ __('None of the above') }}
                        </label>
                    </div>
                    @if ($errors->has('university'))
                    <span class="help is-danger" role="alert">
                        Please select at least one.
                    </span>
                    @endif
                </div>
                @endif

                <button type="submit" class="btn btn-primary" value="{{ __('Next') }}">{{ __('Next') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection