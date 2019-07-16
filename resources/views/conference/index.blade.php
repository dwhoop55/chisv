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
                <h3 class="is-marginless columns is-vcentered">
                    {{ $conference->name }}

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

                <small> {{ $conference->location }}&nbsp; {{ date('d.m', strtotime($conference->start_date)) }} –
                    {{date('d.m.Y', strtotime($conference->end_date))}}</small>
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