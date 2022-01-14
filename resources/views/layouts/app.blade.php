<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ttshop') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/admin/home') }}">
                    {{ config('app.name', 'Laravel') }} 後臺
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest
                    @else
                        <ul class="navbar-nav me-auto">
                            <li>
                                <a class="nav-link" href="{{route('index')}}">
                                    返回前臺
                                </a>
                            </li>
                            @php
                                $role = Auth::user()->role ?? null;
                            @endphp
                            @if($role === 'admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        產品管理
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item 
                                            @if( url()->current() === route('product-categories.index'))
                                                active
                                            @endif
                                        " href="{{ route('product-categories.index') }}">分類</a>
                                        <a class="dropdown-item 
                                            @if( url()->current() === route('products.index'))
                                                active
                                            @endif
                                        " href="{{ route('products.index') }}">列表</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        最新消息管理
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item 
                                            @if( url()->current() === route('event-categories.index'))
                                                active
                                            @endif
                                        " href="{{ route('event-categories.index') }}">分類</a>
                                        {{-- <a class="dropdown-item 
                                            @if( url()->current() === route('events.index'))
                                                active
                                            @endif
                                        " href="{{ route('events.index') }}">列表</a> --}}
                                    </div>
                                </li>
                            @elseif($role === 'customer')
                                <li>
                                    <a class="nav-link" href="{{route('customer.profile')}}">
                                        資料
                                    </a>
                                </li>
                            @else
                                <li>其他非管理者或顧客</li>
                            @endif
                        </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('登入') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('註冊') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if($role === 'admin')
                                        管理者：
                                    @elseif($role === 'customer')
                                        會員： 
                                    @else
                                        <li>非管理者或會員</li>
                                    @endif

                                    {{ Auth::user()->name }} 您好
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('登出') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            @yield('main')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

    </script>
    @yield('js')
</body>
</html>
