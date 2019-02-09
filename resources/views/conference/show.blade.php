@extends('layouts.app')

@section('content')
@if ( Auth::user() && Auth::user()->canAddConference() )
    <a name="editBtn" id="editBtn" class="float-right btn btn-primary" href="{{ route('conference.edit', $conference->slug) }}" role="button">Edit</a>
@endif

<div class="jumbotron">
    <h1 class="display-3">{{ $conference->name }}</h1>
    <p class="lead">{{ $conference->location }}, {{ $conference->date }}</p>
    <hr class="my-2">
    <p>{{ $conference->description }}</p>
</div>
@endsection
