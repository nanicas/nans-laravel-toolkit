<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicons
        <link rel="apple-touch-icon" href="/docs/4.6/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/4.6/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
        <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon.ico">
        <meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
        <meta name="theme-color" content="#563d7c">-->

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('vendor/ladda/ladda.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app_framework.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('css')

        @if(!empty($assets['css']))
            @foreach ($assets['css'] as $css)
                <link rel="stylesheet" href="{{ asset($css) }}"></link>
            @endforeach
        @endif
    </head>
    <body data-base-url="{{ \URL::to('/') }}">
        <div id="app">
            <div id="top-message"></div>
            @yield('content')
            <div id="bottom-message"></div>
        </div>
    </body>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app_framework.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('vendor/ladda/spin.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('vendor/ladda/ladda.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>

    @yield('js')

    @if(!empty($assets['js']))
        @foreach ($assets['js'] as $js)
            <script type="text/javascript" src="{{ asset($js) }}" defer></script>
        @endforeach
    @endif
</html>
