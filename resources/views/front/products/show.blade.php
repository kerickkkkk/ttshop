@extends('layouts.front-app')

@section('main')
<section class="banner vh-50 mb-5">
  <div
    class="bg-cover h-100 position-relative"
    style="background-image: linear-gradient(to bottom , rgba(255, 255, 255, 0.9), rgba(0, 0, 0, 0.8)),
      url({{asset('images/pics/pic-6.jpg')}});"
  >
    <h1 class="position-absolute top-50 start-50 translate-middle">產品詳細</h1>
  </div>
</section>
<section id="products" class="container mb-5">
  <div class="row mb-4">
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
          class="swiper mySwiper2"
        >
          <div class="swiper-wrapper mb-3">
            <div class="swiper-slide">
              <div class="img bg-cover" 
                style="background-image: url({{Storage::url($product->image)}}); height: 300px;">

              </div>
            </div>
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
            <div class="swiper-slide">
              <div class="img bg-cover" 
                style="background-image: url({{Storage::url($product->image)}}); height: 100px;">

              </div>
            </div>
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
                  {{-- <button data-caculate-type="minus" class="caculateBtn btn btn-outline-primary" type="button">-</button>
                  <input min="0" max="99" type="text" class="qty form-control text-end" aria-label="Example text with button" value="1">
                  <button data-caculate-type="plus" class="caculateBtn btn btn-outline-primary" type="button">+</button> --}}
                  <select class="qty form-select" name="qty">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
                </div>
              </div>
            </section>
            <section>
              <div class="text-center">
                {{-- <a href="{{route('products.index')}}" class="btn btn-outline-primary me-2">返回列表</a> --}}
                <button class="addCart btn btn-outline-primary me-2">加入購物車</button>
                {{-- <button class="btn btn-primary">立即購買</button> --}}
              </div>
            </section>

          </div>
          
        </div>
      </div>   
    </div>
  </div>
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
        產品說明
      </button>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
      {!! $product->description !!}
    </div>

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
              <h4 class="card-title">{{$product->name}}</h4>
              <hr>
              <p>NT$ 
                <span class="fs-3">{{number_format($product->price)}}</span>
              </p>
            </div>
            <div class="maskWrap">
              <span style="--i: 1;" class="item"></span>
              <span style="--i: 2;" class="item"></span>
              <span style="--i: 3;" class="item"></span>
              <span style="--i: 4;" class="item"></span>
              <span style="--i: 5;" class="item"></span>
              <span style="--i: 6;" class="item"></span>
              <span style="--i: 7;" class="item"></span>
              <span style="--i: 8;" class="item"></span>
              <span style="--i: 9;" class="item"></span>
              <span style="--i: 10;" class="item"></span>
              <span style="--i: 11;" class="item"></span>
              <span style="--i: 12;" class="item"></span>
              <span style="--i: 13;" class="item"></span>
              <span style="--i: 14;" class="item"></span>
              <span style="--i: 15;" class="item"></span>
              <span style="--i: 16;" class="item"></span>
              <span style="--i: 17;" class="item"></span>
              <span style="--i: 18;" class="item"></span>
              <span style="--i: 19;" class="item"></span>
              <span style="--i: 20;" class="item"></span>
              <span style="--i: 21;" class="item"></span>
              <span style="--i: 22;" class="item"></span>
              <span style="--i: 23;" class="item"></span>
              <span style="--i: 24;" class="item"></span>
              <span style="--i: 25;" class="item"></span>
            </div>
            <div class="card-content">
              <div class="text-center">
                <h4 class="card-title text-white">{{$product->name}}</h4>
                <a href="{{route('products.show',['product'=> $product->id])}}" role="button" class="text-decoration-none stretched-link text-center text-white btn btn-outline-primary">
                  查看更多
                </a>
              </div>
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
    .then(res=> res.json())
    .then(({success,status,message,totalQty })=>{
      if(success){
        Swal.fire(
          `${message}`,
          '',
          `${status}`,
          ).then(res=>{
            console.log(totalQty);
            $('#totalQty').text(totalQty);
          })
      }
    })
}
</script>

@endsection

