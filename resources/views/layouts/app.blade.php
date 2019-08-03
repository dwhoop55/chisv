<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @isset($title)
        {{ $title }} |
        @endisset {{ config('app.name') }}
    </title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/3.8.95/css/materialdesignicons.min.css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        {{-- Flash any messages --}}
        @include('flash-message')

        <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/home') }}">
                    {{ config('app.name', 'chisv') }}
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
                    @click="showMobileNav = !showMobileNav" :class="{ 'is-active': showMobileNav }">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div class="navbar-menu" :class="{ 'is-active': showMobileNav }">
                <div class="navbar-start">
                    @auth
                    <a class="navbar-item" href="{{ route('conference.index') }}">
                        Conferences
                    </a>
                    @endauth
                    @can('index', App\User::class)
                    <a class="navbar-item" href="{{ route('user.index') }}">
                        Users
                    </a>
                    @endcan
                </div>

                <div class="navbar-end">
                    @guest
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary" href="{{ route('register') }}">
                                <strong>Sign up</strong>
                            </a>
                            <a class="button is-light" href="{{ route('login') }}">
                                Log in
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            {{ Auth::user()->firstname }}
                        </a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{ route('user.edit', Auth::user()->id) }}">
                                My Profile
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            $('#logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </div>
                    @endguest
                </div>

            </div>
        </nav>

        <div class="@if (!isset($fullContent)) section @endif">
            @yield('content')
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>