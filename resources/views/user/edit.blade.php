@extends('layouts.app', ['title' => $user->firstname . ' ' . $user->lastname])

@section('content')

<div class="columns is-centered">
    <div class="column is-two-thirds">
        <user-edit :can-grant="'{{ auth()->user()->can('create', 'App\Permission') }}'"
            :can-delete="'{{ auth()->user()->can('delete', $user) }}'" :user-id="'{{ $user->id }}'">
        </user-edit>
    </div>
</div>

@endsection