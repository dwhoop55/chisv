@extends('layouts.app')

@section('content')
@if ( Auth::user() && Auth::user()->canAddConference() )
    <a name="addBtn" id="addBtn" class="float-right btn btn-primary" href="{{ route('conference.create') }}" role="button">Add</a>
@endif
      @foreach ($conferences as $conference)
          <p> <a class="h3" href="{{ route('conference.show', $conference->slug) }}"> {{ $conference->name }} </a></p>
      @endforeach
@endsection
