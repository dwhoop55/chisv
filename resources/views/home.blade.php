@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Hi {{ auth()->user()->firstname }}
            </h1>
            <h2 class="subtitle">
                You are logged in!
            </h2>
        </div>
    </div>
</section>

@endsection