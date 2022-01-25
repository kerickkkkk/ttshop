@extends('layouts.front-app')
@section('css')
<style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;

        /* Center slide text vertically */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection
@section('main')
    <div id="banner" class="bg-cover mt-n88 vh-100" 
        style="background-image: linear-gradient(rgba(200, 200, 200, 0.6), rgba(255, 255, 255, 0.6)),
        url({{asset('images/pics/pic-4.jpg')}});"
        >
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-7 offset-md-1 position-relative z-index-1 vh-100">
                    <div class="row flex-column justify-content-center h-100">
                        <div class="pt-5">
                            <h2 class="h1 fw-bold">
                                <span class="bg-light text-primary lh-lg d-inline-block">
                                    來塊花生糖
                                </span>
                            </h2>
                            <p class="fw-bold mb-3 h4">
                                <span class="bg-light lh-lg d-inline-block">
                                    泡好一壺熱茶，配上童年的那份回憶，心裡都暖了起來！
                                </span>
                            </p>
                            <a href="{{route('products.index')}}" class="btn btn-primary">立即前往 >> </a>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 fs-1 bounce start-25 translate-middle opacity-50">
                        <a class="text-dark d-block px-3" role="button" href="#sale">
                            <i class="fas fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-7 position-md-static position-absolute top-0 bottom-0 end-0 overflow-hidden">
                    <video style="height: calc(100vh);" autoplay muted>
                        <source src="{{asset('video/banner-1.mp4')}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
    {{-- 促銷內容 --}}
    <div id="sale" class="p-5">
        {{-- 輪播方式 --}}
        <div class="swiper saleSwiper">
            <div class="swiper-wrapper">
                @foreach ($eventSales as $event)
                    <div style="background-image: linear-gradient(rgba(200, 200, 200, 0.3), rgba(255, 255, 255, 0.6)), url({{Storage::url($event->image)}});" class="swiper-slide bg-cover vh-25">
                        <a href="{{route('events.show',['event'=> $event->id])}}" class="text-secondary bg-dark p-3 text-decoration-none btn btn-primary border-0 stretched-link">
                            <div class="h1">
                                {{$event->title}}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <section id="story"
        class="py-5 bg-cover"
        style="background-image: linear-gradient(to right , rgba(150, 150, 150, 0.6), rgba(0, 0, 0, 0.8)),url({{asset('images/pics/pic-5.jpg')}});"
    >
        <div  class="container" >
            <div class="row position-relative align-items-center">
                <div class="offset-md-1 col-md-4">
                    <div style="background-image: url({{asset('images/index/about-1.jpg')}})" class="bg-cover vh-50">
                    </div>
                </div>
                <div class="offset-md-1 col-md-4 col-6 align-self-md-center pt-md-5 position-md-static position-absolute top-50 start-50 translate-middle-md-none translate-middle text-md-light text-dark text-md-start text-center">
                    <h2 class="text-primary">
                        創立初衷
                    </h2>
                    <p>
                        從小就在田野中長大的鄕下孩子，扣除上學的時間外，孩提的記憶中都是在田野或是三合院度過，手上拿著東西不是鉛筆或是GAME BOY，而是...
                    </p>
                    <a href="{{route('about.index')}}" class="btn btn-primary">關於我們...</a>
                </div>
                {{-- <div class="col-md-4 bg-primary-light"></div> --}}
            </div>
        </div>
    </section>
    <section class="container-fluid bg-cover vh-50 parallax"
        style="background-image: 
            linear-gradient(to right , rgba(150, 150, 150, 0.01), rgba(0, 0, 0, 0.8)),
                url({{asset('images/pics/pic-1.jpg')}});"
        >
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6">
                <h3 class="align-self-center text-md-end text-center text-white">
                    閉上眼，乘著涼風，<br>
                    享受著屬於每個人專屬的午後。
                </h3>
            </div>
        </div>     
    </section>
    <section class="container py-5">
        <h2 class="text-primary text-center">開始品嘗美好</h2>
        <div class="row mb-3 justify-content-center">
            <div class="col-md-4 col-8 text-center">
                <p>
                    經驗豐富的老師傅，將生花生在高溫的翻炒下，讓花生本身內部產生的變化，提香後，把握黃金的時程，將香氣鎖住，
                    無需防腐劑，無添加甜味劑，讓您輕鬆無負擔。
                </p>
                <a href="{{route('products.index')}}" class="btn btn-primary">立即查看</a>
            </div>
        </div>
        <div class="row justify-content-md-center justify-content-around">
            @foreach ($productCategories as $productCategory)
                <div class="col">
                    <div class="position-relative shadow-sm">
                        <div class="bg-cover vh-50"
                        style="background-image: url({{Storage::url($productCategory->image)}})"
                        >
                        </div>
                        <a href="{{route('products.index',['currentCategory'=> $productCategory->id])}}" class="btn btn-outline-primary d-block border-0 text-decoration-none stretched-link">
                            <h4 class="text-center">{{$productCategory->name}}</h4>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <section class="bg-light py-3">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">特色一</h6>
                            <h3 class="card-title bg-primary-light">當季作物</h3>
                            <p class="card-text">
                                現採現收，保證新鮮
                                <br>
                                <br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">特色二</h6>
                            <h3 class="card-title bg-primary-light">檢驗分析</h3>
                            <ul class="list-unstyled card-text">
                                <li>土地的重金屬殘留檢驗</li>                 
                                <li>310項農藥殘留檢驗</li>
                                <li>營養成份檢驗分析</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">特色三</h6>
                            <h3 class="card-title bg-primary-light">產品標示</h3>
                            <p class="card-text">
                                使消費者能了解成分，<br>
                                食的安心，<br>
                                並且獲得正確的訊息。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="news" class="container py-5">
        <div class="row">
            <div class="col-md-3 text-md-left text-center mb-3 pt-4">
                <h2 class="text-primary">最新消息</h2>
                <p>
                    最新的促銷活動，公告都在這。
                </p>
                <a href="{{route('events.index')}}" class="btn btn-primary">
                    查看更多
                </a>
            </div>
            <div class="col-md-9">
                <div class="swiper newsSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($events as $event)
                            <div class="swiper-slide">
                                <div class="card shadow-sm w-100">
                                <div class="bg-cover card-img-top" 
                                        style="height: 200px; background-image: url({{Storage::url($event->image)}});">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-primary">{{$event->title}}</h3>
   
                                    <h5 class="card-title text-primary h6">{{$event->eventCategory->name}}</h5>
                                    </div>
                                    <hr>
                                    <p class="text-muted">{{$event->date}}</p>
                                    <p>
                                    {{$event->content}}
                                    </p>

                                    <a href="{{route('events.show',['event'=> $event->id])}}" class="text-decoration-none btn btn-primary stretched-link">
                                        查看詳細
                                    </a>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    
@endsection

@section('js')
<script>
    var saleSwiper = new Swiper(".saleSwiper", {
        slidesPerView: 3,
        spaceBetween: 30,

    });
    var newsSwiper = new Swiper(".newsSwiper", {
        slidesPerView: 1.5,
        spaceBetween: 30,
        breakpoints: {
            768: {
                slidesPerView: 2.5,
                spaceBetween: 30
            },
            996: {
                slidesPerView: 3.5,
                spaceBetween: 30
            }
        },
    });
</script>
@endsection