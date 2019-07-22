@extends('layouts.app', ['title' => 'Users'])

@section('content')

<div class="section">
    @foreach ($users as $user)
    <pre>{{ $user }}</pre>
    @endforeach
</div>

@endsection