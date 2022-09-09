@extends('layouts.app')
@section('content')
    <!--<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                @if(!empty($data['slug']))
                   {{ $data['slug']->getName() }}
                @else
                    {{ config('app.name', 'Laravel') }}
                @endif                
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.index') }}">Dashboard</a>
                    </li>

                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif

                    @if (Route::has('register') && !empty($data['slug']))
                        <li class="nav-item">

                            @php
                                $registerUrl = env('FALLBACK_APP_URL');
                                $registerUrl .= '/register?' .\Zevitagem\LegoAuth\Helpers\Helper::createBuildQueryToOutLogin([
                                    'slug' => $data['slug']->getId()
                                ]);
                            @endphp

                            <a class="nav-link" href="{{ $registerUrl }}">
                                {{ __('Cadastro') }}
                            </a>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nÏav ml-auto">
                </ul>
            </div>
        </div>
    </nav>-->

    <main>
        <div id="top-message" class="alert none"></div>
        @yield('site-content')
    </main>
@endsection