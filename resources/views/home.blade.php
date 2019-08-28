@extends('layouts.app')

@section('content')

<home :user="{{ auth()->user() }}"></home>

{{-- <section class="hero">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Hi {{ auth()->user()->firstname }}
</h1>
<div class="columns is-multiline is-flex-conferences">
    <div class="column is-half">
        <a href="conferenceUrl">
            <div class="card is-hoverable-anim is-clickable is-100vh has-text-centered has-padding-3 is-size-4">
                Conferences</div>
        </a>
    </div>
</div>
</div>
</div>
</section> --}}

@endsection