<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth

                        <ul class="navbar-nav me-auto">
                            @if (auth()->user()->role == 'admin')
                                <li class="nav-item px-2">
                                    <a href="{{ route('category.index') }}"
                                        style="text-decoration: none; color: inherit">category</a>
                                </li>
                                <div class="vr"></div>
                                <li class="nav-item px-2">
                                    <a href="{{ route('items.index') }}"
                                        style="text-decoration: none; color: inherit">item</a>
                                </li>
                                <div class="vr"></div>
                                <li class="nav-item px-2">
                                    <a href="{{ route('kupon.index') }}"
                                        style="text-decoration: none; color: inherit">kupon</a>
                                </li>
                                <div class="vr"></div>
                                <li class="nav-item px-2">
                                    <a href="{{ route('transaction.index') }}"
                                        style="text-decoration: none; color: inherit">transaction</a>
                                </li>
                                <div class="vr"></div>
                                <li class="nav-item px-2">
                                    <a href="{{ route('transaction.history') }}"
                                        style="text-decoration: none; color: inherit">history</a>
                                </li>
                            @else
                                <li class="nav-item px-2">
                                    <a href="{{ route('transaction.index') }}"
                                        style="text-decoration: none; color: inherit">transaction</a>
                                </li>
                                <div class="vr"></div>
                                <li class="nav-item px-2">
                                    <a href="{{ route('transaction.history') }}"
                                        style="text-decoration: none; color: inherit">history</a>
                                </li>
                            @endif

                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <div class="row">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>


                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <hr class="sidebar-divider my-2">

                                        {{-- @foreach ($user as $u) --}}
                                        <a href="{{ route('profile.index') }}" class="dropdown-item">kupon</a>
                                        {{-- @endforeach --}}


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>


                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
