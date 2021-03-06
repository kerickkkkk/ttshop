<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ttshop') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Festive&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .font-festive{
            font-family: 'Festive', cursive;
        }
    </style>
    @yield('css')
</head>
<body>
    @php
        $role = Auth::user()->role ?? null;
    @endphp
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand font-festive" href="{{route('home') }}">
                    {{ config('app.name', 'Laravel') }} 
                    @guest
                    @else
                        @if($role === 'admin')
                            後臺
                        @endif
                    @endguest
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

                            @if($role === 'admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        產品管理
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item 
                                            @if( url()->current() === route('admin.product-categories.index'))
                                                active
                                            @endif
                                        " href="{{ route('admin.product-categories.index') }}">分類</a>
                                        <a class="dropdown-item 
                                            @if( url()->current() === route('admin.products.index'))
                                                active
                                            @endif
                                        " href="{{ route('admin.products.index') }}">列表</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        最新消息管理
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item 
                                            @if( url()->current() === route('admin.event-categories.index'))
                                                active
                                            @endif
                                        " href="{{ route('admin.event-categories.index') }}">分類</a>
                                        <a class="dropdown-item 
                                            @if( url()->current() === route('admin.events.index'))
                                                active
                                            @endif
                                        " href="{{ route('admin.events.index') }}">列表</a>
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link" href="{{route('admin.contacts.index')}}">
                                        顧客留言
                                    </a>
                                </li>
                            @elseif($role === 'customer')
                                <li>
                                    <a class="nav-link" href="{{route('customer.profile')}}">
                                        會員資料
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
