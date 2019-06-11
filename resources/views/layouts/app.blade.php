<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
    <title>@yield('title') - {{ config('app.name') }}</title>
    @else
    <title>{{ config('app.name') }}</title>
    @endif

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <a role="button" class="navbar-burger burger" aria-label="{{ __('Toggle navigation') }}"
                    aria-expanded="false" data-target="navMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navMenu" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{ route('home.index') }}">
                        Home
                    </a>

                    <a class="navbar-item" href="{{ route('conference.index') }}">
                        Conferences
                    </a>
                </div>
            </div>

            <div class="navbar-end">
                @guest
                <div class="navbar-item">
                    <div class="field is-grouped">

                        <p class="control">
                            <a class="button is-primary-inverted" href="{{ route('register') }}">
                                {{ __('Sign up') }}
                            </a>
                        </p>

                        <p class="control">
                            <a class="button is-primary-inverted" href="{{ route('login') }}">
                                <strong>{{ __('Login') }}</strong>
                            </a>
                        </p>
                    </div>
                </div>
                @else
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        {{ Auth::user()->firstname }} <span class="caret"></span>
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </div>
                </div>
                @endguest
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>