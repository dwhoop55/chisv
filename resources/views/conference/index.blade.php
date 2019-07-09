@extends('layouts.app')

@section('content')
@can('create', Conference::class)
<button class="button button-primary is-right" href="{{ route('conference.create') }}">Add</button>
@endcan
@foreach ($conferences as $conference)
<p> <a class="h3" href="{{ route('conference.show', $conference->key) }}"> {{ $conference->name }} </a></p>
@endforeach
@endsection