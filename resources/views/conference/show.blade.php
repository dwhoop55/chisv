@extends('layouts.app', ['title' => $conference->name])

@section('content')


<div class="hero-container">

    <img class="hero-img-blur"
        src="@if ($conference->image) {{$conference->image->path}} @else /images/conference-default.jpg @endif" />
    <img class="hero-img"
        src="@if ($conference->image) {{$conference->image->path}} @else /images/conference-default.jpg @endif" />

    <div class="hero">
        <div class="hero-body">

            @can('update', $conference)
            <div class="container is-topmost">
                <div class="field">
                    <a class="button is-pulled-right"
                        href="{{ route('conference.edit', $conference->key) }}">Settings</a>
                </div>
            </div>
            @endcan

            <div class="container">
                <h2 class="is-marginless columns is-vcentered has-text-weight-bold has-text-grey-darker">
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
                </h2>

                <p class="has-text-weight-semibold has-text-black-ter"> {{ $conference->location }}&nbsp;
                    {{ $user->formatDate($conference->start_date, $user->date_format) }} –
                    {{ $user->formatDate($conference->end_date, $user->date_format) }}</p>
                </p>
                <p class="has-padding-t-7 has-text-weight-medium has-text-black-ter">{{ $conference->description }}</p>
            </div>
        </div>
    </div>
</div>

@endsection