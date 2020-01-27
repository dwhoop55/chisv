@extends('layouts.app', ['title' => $user->firstname . ' ' . $user->lastname])

@section('content')

<div class="columns is-centered">
    <div class="column is-two-thirds">
        <user-edit :id="'{{ $user->id }}'"></user-edit>
    </div>
</div>

@endsection