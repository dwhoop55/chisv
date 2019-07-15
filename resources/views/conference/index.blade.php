@extends('layouts.app', ['title' => 'Conferences'])

@section('content')

@can('create', App\Conference::class)
<div class="container">
    <div class="field">
        <a class="button is-pulled-right" href="{{ route('conference.create') }}">Add new Conference</a>
    </div>
</div>
@endcan

<div class="section">
    @foreach ($conferences as $conference)
    <article class="media">
        <figure class="media-left">
            <p class="image is-128x128">
                <img src="https://bulma.io/images/placeholders/128x128.png">
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ $conference->name }}</strong>
                    <br>
                    <small><i>{{ ucwords($conference->state->name) }}</i> –
                        {{ $conference->location }} – {{ $conference->date }}</small>
                    <br>
                    {{ str_limit($conference->description, 350, $end = '...') }}
                </p>
            </div>
            <a class="button is-primary" href="{{ route('conference.show', $conference) }}">More</a>
            @can('update', $conference)
            <a class="button" href="{{ route('conference.edit', $conference) }}">Settings</a>
            @endcan
        </div>
    </article>
    @endforeach
</div>

@endsection