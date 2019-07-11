@extends('layouts.app', ['title' => $conference->name])

@section('content')

@can('update', $conference)
<div class="container">
    <div class="field">
        <a class="button is-pulled-right" href="{{ route('conference.edit', $conference->key) }}">Edit</a>
    </div>
</div>
@endcan

<section class="hero">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                {{ $conference->name }}
            </h1>
            <h2 class="subtitle">
                <small><i>{{ ucwords($conference->state->name) }}</i> –
                    {{ $conference->location }} – {{ $conference->date }}</small>
            </h2>
        </div>
        <p class="has-padding-t-7">{{ $conference->description }}</p>
    </div>
</section>

@endsection