@extends($view_prefix . 'layouts.app')

@section('css')
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>

<style>
    body {
        font-size: .875rem;
    }

    .feather {
        width: 16px;
        height: 16px;
        vertical-align: text-bottom;
    }

    /*
     * Sidebar
     */

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100; /* Behind the navbar */
        padding: 48px 0 0; /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 5rem;
        }
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    }

    @supports ((position: -webkit-sticky) or (position: sticky)) {
        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
        }
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333;
    }

    .sidebar .nav-link .feather {
        margin-right: 4px;
        color: #999;
    }

    .sidebar .nav-link.active {
        color: #007bff;
    }

    .sidebar .nav-link:hover .feather,
    .sidebar .nav-link.active .feather {
        color: inherit;
    }

    .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
    }

    /*
     * Navbar
     */

    .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: 1rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .navbar-toggler {
        top: .25rem;
        right: 1rem;
    }

    .navbar .form-control {
        padding: .75rem 1rem;
        border-width: 0;
        border-radius: 0;
    }

    .form-control-dark {
        color: #fff;
        background-color: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .1);
    }

    .form-control-dark:focus {
        border-color: transparent;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
    }
</style>
@endsection

@section('content')
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">
        {{ $session_data['user']['name'] }}
        @yield('user-name-complement')
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 Sair
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('site') }}">
                            <span data-feather="airplay"></span>
                            Site <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ ($screen == 'home') ? 'active' : '' }}" href="{{ route('home.index') }}">
                            <span data-feather="layout"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    @if($is_admin)
                    <li class="nav-item">
                        <a class="nav-link {{ ($screen == 'modality') ? 'active' : '' }}" href="{{ route('modality.index') }}">
                            <span data-feather="grid"></span>
                            Modalidades
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ ($screen == 'historic') ? 'active' : '' }}" href="{{ route('historic.index') }}">
                            <span data-feather="save"></span>
                            Históricos
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ (strpos($screen, '_config') !== false) ? 'active' : '' }}" href="{{ route('user_config.index') }}">
                            <span data-feather="settings"></span>
                            Configuração
                        </a>
                    </li>
                    
                    @yield('menu-items')
                </ul>

                <!--<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Saved reports</span>
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Current month
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Last quarter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Social engagement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Year-end sale
                        </a>
                    </li>
                </ul>-->
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <br>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Dashboard</a></li>

                  @php
                    $routeInstance = \Request::route();
                    $routeName = $routeInstance->getName();
                    $routeParameters = $routeInstance->parameters();
                    $routePaths = explode('.', $routeName);
                    $totalRoutePaths = count($routePaths);
                    $isListPage = ($totalRoutePaths == 2 && $routePaths[1] == 'index');
                  @endphp

                  @if($totalRoutePaths == 1)
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route($routeName) }}">{{ $routeName }}</a></li>
                  @else
                    @php
                        $concatRoute = '';
                        $iRoute = 0;
                    @endphp
                    @foreach($routePaths as $currentRoute)

                        @if($iRoute == 0)
                            @php
                                $concatRoute = $currentRoute;
                                $routeToPrint = $concatRoute .'.index';
                            @endphp
                        @else
                            @php
                                $concatRoute .= '.'. $currentRoute;
                                $routeToPrint = $concatRoute;
                            @endphp
                        @endif

                        <li class="breadcrumb-item {{ (++$iRoute == $totalRoutePaths) ? 'active' : '' }}" aria-current="page">
                            <a href="{{ route($routeToPrint, $routeParameters) }}">{{ $routeToPrint }}</a>
                        </li>

                        @if($isListPage)
                            @php break; @endphp
                        @endif
                    @endforeach
                  @endif
                </ol>
            </nav>

            @yield('dashboard-content')
        </main>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset($packaged_assets_prefix . '/vendor/bootstrap-theme/feather.min.js') }}"></script>
<script>
    (function () {
    'use strict'

    feather.replace();
})();
</script>
@endsection
