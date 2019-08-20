@extends('layouts.app', ['title' => $conference->name])

@section('content')
<div class="columns is-centered">
    <div class="column is-two-thirds">
        <conference-edit :conference-key="'{{ $conference->key }}'" can-delete="{{ auth()->user()->isAdmin() }}">
        </conference-edit>
    </div>
</div>
@endsection