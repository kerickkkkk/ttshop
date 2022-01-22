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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link
    rel="stylesheet"
    href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
    />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        #loading{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,.6);
            z-index: 9999;
        }
    </style>
    @yield('css')
</head>
<body>
    <div id="loading">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="h1 text-white">
                Loading...
            </div>
        </div>
    </div>
    {{-- <div id="app"> --}}
        <div class="p-44"></div>
        <nav class="navbar navbar-expand-md navbar-light bg-transparent py-4 shadow-sm fixed-top transition-all-1">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav position-md-absolute top-50 start-50 translate-middle-md">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('index')}}">首頁</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('events.index')}}">最新消息</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('products.index')}}">精選產品</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">關於我們</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">常見問題</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('carts.step01.index')}}">購物車</a>
                        </li>
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="far fa-user"></i>{{ __('登入') }}</a>
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
                                    {{ Auth::user()->name }} 您好
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @php
                                        $role = Auth::user()->role ?? null;
                                    @endphp
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        @if($role === 'customer')
                                            會員資料
                                        @elseif($role === 'admin')
                                            管理介面
                                        @endif
                                    </a>
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
        <main>
            @yield('content')
            @yield('main')
        </main>
        <footer class="bg-dark py-4 text-center text-white"> ⓒ 2022 ttshop All Right Reserved. </footer>
    {{-- </div> --}}
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(function(){
            $(window).on('load',function(){
                $('#loading').fadeOut()
            })

            $(window).on('scroll', scrollHandler)


            function scrollHandler(){
                const saleScrollTop = $('#sale') ? $('#sale').offset()?.top : null;
                if(this.scrollY > 100){
                    $('.navbar').removeClass('navbar-light bg-transparent py-4')
                        .addClass('navbar-dark bg-dark py-2 opacity-75')
                }else{
                    $('.navbar').removeClass('navbar-dark bg-dark opacity-75 py-2')
                        .addClass('navbar-light bg-transparent py-4')
                }
                if(this.scrollY > saleScrollTop){
                    $('.navbar').removeClass('opacity-75')
                }
            }
        })
    </script>
    @if( Session::has('message'))
        <script>
            Swal.fire(
                "{{session('message')}}",
                '',
                "{{session('status')}}"
            )
        </script>
    @endif
    @yield('js')
</body>
</html>
