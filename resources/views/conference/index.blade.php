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
            <a href="{{ route('conference.show', $conference) }}" class="image is-128x128">
                @if ($conference->icon)
                <img src="{{ $conference->icon->path }}">
                @else
                <img href="{{ route('conference.show', $conference) }}"
                    src="https://robohash.org/{{ $conference->key }}">
                @endif
            </a>
        </figure>
        <div class="media-content">
            <div class="content">
                <h3 class="is-marginless columns is-vcentered">
                    <a href="{{ route('conference.show', $conference) }}">{{ $conference->name }}</a>

                    @if ($conference->enable_bidding)
                    <div class="tags has-addons">
                        @endif
                        <span class="tag has-margin-l-7 is-rounded @switch($conference->state->id)
                            @case($overState->id)
                            is-light
                            @break
                            @case($planningState->id)
                            is-danger
                            @break
                            @default
                            is-success
                            @endswitch">{{ ucwords($conference->state->name) }}
                        </span>
                        @if ($conference->enable_bidding)
                        <span class="tag is-rounded is-success"> Bidding open </span>
                    </div>
                    @endif
                </h3>

                <small> {{ $conference->location }}&nbsp;
                    {{ $user->formatDate($conference->start_date, $user->date_format) }} –
                    {{ $user->formatDate($conference->end_date, $user->date_format) }}</small>
                <br>
                {{ str_limit($conference->description, 350, $end = '...') }}
                </p>
            </div>
            @can('update', $conference)
            <a class="button" href="{{ route('conference.edit', $conference) }}">Settings</a>
            @endcan
        </div>
    </article>
    @endforeach
</div>

@endsection