@extends('layouts.front-app')

@section('main')
<section class="banner vh-50 mb-5">
  <div
    class="bg-cover h-100 position-relative"
    style="background-image: linear-gradient(to bottom , rgba(255, 255, 255, 0.9), rgba(0, 0, 0, 0.8)),
      url(https://images.unsplash.com/photo-1559186057-001c5f061d68?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80);"
  >
    <h1 class="position-absolute top-50 start-50 translate-middle">產品詳細</h1>
  </div>
</section>
<section id="products" class="container mb-5">
  <div class="row">
    <div class="col-lg-3 mb-3 sticky-top">
      <h2 class="mb-3 text-lg-start text-center text-primary">產品分類</h2>
      <div class="list-group flex-lg-column d-lg-flex d-block text-lg-start text-center" id="list-tab" role="tablist">
        @foreach ($productCategories as $productCategory)
          <a 
            href="{{route( 'products.index',['currentCategory'=> $productCategory->id] )}}"
            class="list-group-item list-group-item-action border border-1 me-lg-0 me-2 d-lg-block d-inline-block w-lg-auto w-auto
            @if ($currentCategory == $productCategory->id)
                active
            @endif
          " data-category_id="{{ $productCategory->id }}" role="button">{{ $productCategory->name }}</a>
        @endforeach
        <a 
          href="{{route( 'products.index',['currentCategory' => 'all'] )}}"
          class="list-group-item list-group-item-action border border-1 d-lg-block d-inline-block w-lg-auto w-auto
          @if ($currentCategory ==='all')
            active
          @endif
        " data-category_id="0" role="button">全部商品</a>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="card flex-md-row" data-product-id="{{$product->id}}">
        <div class="col-md-5 mb-md-0 mb-3">
          <div
          style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
          class="swiper mySwiper2"
        >
          <div class="swiper-wrapper mb-3">
            @foreach ($product->productImages as $image)
              <div class="swiper-slide">
                <div class="img bg-cover" 
                  style="background-image: url({{Storage::url($image->image)}}); height: 300px;">

                </div>
              </div>
            @endforeach
          
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
        <div thumbsSlider="" class="swiper mySwiper">
          <div class="swiper-wrapper">
            @foreach ($product->productImages as $image)
            <div class="swiper-slide">
              <div class="img bg-cover" 
                style="background-image: url({{Storage::url($image->image)}}); height: 100px;">

              </div>
            </div>
            @endforeach
          </div>
        </div>
        </div>
        <div class="col-md-7">
          <div class="card-body d-flex flex-column justify-content-between h-100">
            <section>
              <h3>品名：{{ $product->name }}</h3>
              <p>價格：{{ $product->price }}</p>
              <p class="card-text">內容：{{ $product->content }}</p>
              <div class="d-flex align-items-center mb-3">
                數量：
                <div class="input-group w-50">
                  <button data-caculate-type="minus" class="caculateBtn btn btn-outline-primary" type="button">-</button>
                  <input min="0" max="99" type="text" class="qty form-control text-end" aria-label="Example text with button" value="1">
                  <button data-caculate-type="plus" class="caculateBtn btn btn-outline-primary" type="button">+</button>
                </div>
              </div>
            </section>
            <section>
              <div class="text-center">
                {{-- <a href="{{route('products.index')}}" class="btn btn-outline-primary me-2">返回列表</a> --}}
                <button class="addCart btn btn-outline-primary me-2">加入購物車</button>
                <button class="btn btn-primary">立即購買</button>
              </div>
            </section>

          </div>
          
        </div>
      </div>   
    </div>
  </div>
  <div class="row">
    產品說明
    {!! $product->description !!}
  </div>
</section>
<hr class="container my-3">
{{-- 相關產品 --}}
<section id="relativeProduct" class="container mb-5">
  <h3 class="text-primary text-center mb-3">相關產品</h3>

  <div class="swiper relativeProductSwiper">
      <div class="swiper-wrapper">
        @foreach ($relativeProducts as $product)
        <div class="swiper-slide mb-3">
          <div class="card shadow-sm w-100">
            <div class="bg-cover card-img-top" 
                  style="height: 200px; background-image: url({{Storage::url($product->image)}});">
            </div>
            <div class="card-body text-center">
              <h5 class="card-title text-primary h6">{{$product->name}}</h5>
              <a href="{{route('products.show',['product'=> $product->id])}}" class="text-decoration-none stretched-link">
                <h4 class="card-title">{{$product->name}}</h4>
              </a>
              <hr>
              <p>NT$ 
                <span class="fs-3">{{number_format($product->price)}}</span>
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

var relativeProductSwiper = new Swiper(".relativeProductSwiper", {
  slidesPerView: 2,
  spaceBetween: 30,
  breakpoints: {
      768: {
          slidesPerView: 4,
          spaceBetween: 30
      },
  },
});

var swiper = new Swiper(".mySwiper", {
  spaceBetween: 10,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});
$('.addCart').on('click', submitForm)

function submitForm(){
  const id = $("[data-product-id]").data('productId')
  const qty = $('.qty').val()
  let formData = new FormData()
  const url = "{{route('carts.store')}}";
  formData.append('_token', '{{csrf_token()}}');
  formData.append('id', id);
  formData.append('qty', qty);

  const data = {
    method: 'POST',
    body: formData
  }
  fetch(url, data)
    .then(res=> res.text())
    .then(res=>{
      alert(res);
    })
    
    
}
</script>

@endsection

