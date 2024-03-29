<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    <meta name="description" content="chisv: Student Volunteer Management System. Register & enroll to become an SV" />
    <meta name="keywords"
        content="chisv,SV,SVs,student volunteer,student volunteer management system,chi,enroll,become an sv">

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
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <navbar></navbar>

        <div class="section">
            <router-view></router-view>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>