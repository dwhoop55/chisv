@extends('layouts.auth')
@section('content')


<div class="container">
    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title is-block has-text-centered">
                        Sign up
                    </p>
                </header>
                <div class="card-content">
                    <user-register></user-register>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection