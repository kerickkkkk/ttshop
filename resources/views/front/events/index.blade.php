@extends('layouts.front-app')

@section('main')
{{-- banner --}}
<section class="banner vh-50 mb-5">
  <div
    class="bg-cover h-100 position-relative"
    style="background-image: linear-gradient(to bottom , rgba(255, 255, 255, 0.9), rgba(0, 0, 0, 0.8)),
      url(https://images.unsplash.com/photo-1559186057-001c5f061d68?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80);"
  >
    <h1 class="position-absolute top-50 start-50 translate-middle">最新消息</h1>
  </div>
</section>

<section class="container mb-5">
  <div class="row">
    <div class="col-lg-3 mb-3 sticky-top">
      <h2 class="mb-3 text-lg-start text-center text-primary">最新消息</h2>
      <div class="list-group flex-lg-column d-lg-flex d-block text-lg-start text-center" id="list-tab" role="tablist">
        @foreach ($eventCategories as $eventCategory)
          <a
            href="{{route( 'events.index',['currentCategory'=> $eventCategory->id] )}}"
            class="list-group-item list-group-item-action border border-1 me-lg-0 me-2 d-lg-block d-inline-block w-lg-auto w-auto
            @if ($currentCategory == $eventCategory->id)
              active
            @endif
          " data-category_id="{{ $eventCategory->id }}" role="button">{{ $eventCategory->name }}</a>
        @endforeach
        <a 
          href="{{route('events.index',['currentCategory'=> 'all'] )}}"
          class="list-group-item list-group-item-action border border-1 d-lg-block d-inline-block w-lg-auto w-auto
        
          @if ($currentCategory === 'all')
            active
          @endif
        
        " data-category_id="0" role="button">所有消息</a>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="row">
        @foreach ($events as $event)
          <div class="col-md-4 col-6 mb-3">
            <div class="card shadow-sm w-100">
              <div class="bg-cover card-img-top" 
                    style="height: 200px; background-image: url({{Storage::url($event->image)}});">
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <a href="{{route('events.show',['event'=> $event->id])}}" class="text-decoration-none stretched-link">
                    <h3 class="card-title">{{$event->title}}</h3>
                  </a>
                  <h5 class="card-title text-primary h6">{{$event->eventCategory->name}}</h5>
                </div>
                <hr>
                <p class="text-muted">{{$event->date}}</p>
                <p>
                  {{$event->content}}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<hr class="container my-3">
{{-- 相關消息 --}}
<section id="relativeEvent" class="container mb-5">
  <h3 class="text-primary text-center mb-3">猜您也喜歡</h3>
  <div class="swiper relativeEventSwiper">
      <div class="swiper-wrapper">
        @foreach ($events as $event)
        <div class="swiper-slide">
          <div class="card shadow-sm w-100">
            <div class="bg-cover card-img-top" 
                  style="height: 200px; background-image: url({{Storage::url($event->image)}});">
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <a href="{{route('events.show',['event'=> $event->id])}}" class="text-decoration-none stretched-link">
                  <h3 class="card-title">{{$event->title}}</h3>
                </a>
                <h5 class="card-title text-primary h6">{{$event->eventCategory->name}}</h5>
              </div>
              <hr>
              <p class="text-muted">{{$event->date}}</p>
              <p>
                {{$event->content}}
              </p>
            </div>
          </div>

        </div>
        @endforeach
      </div>
  </div>
</section>
@endsection

@section('js')
<script>

var relativeEventSwiper = new Swiper(".relativeEventSwiper", {
  slidesPerView: 2,
  spaceBetween: 30,
  breakpoints: {
      768: {
          slidesPerView: 4,
          spaceBetween: 30
      },
  },
});
</script>

@endsection

