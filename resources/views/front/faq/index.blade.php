@extends('layouts.front-app')

@section('main')
<section class="banner vh-50 mb-5">
  <div
    class="bg-cover h-100 position-relative"
    style="background-image: linear-gradient(to bottom , rgba(255, 255, 255, 0.9), rgba(0, 0, 0, 0.8)),
      url({{asset('images/pics/pic-7.jpg')}});"
  >
    <h1 class="position-absolute top-50 start-50 translate-middle">FAQ</h1>
  </div>
</section>
<section class="container">
  <div class="row">
    <h3 class="d-flex text-primary" data-bs-toggle="collapse" data-bs-target="#status1" role="button">
      不接受退換貨的狀況
      <button class="btn btn-primary ms-auto" type="button" >
        +
      </button>
    </h3>
    <div class="collapse show" id="status1">
      <div class="card card-body bg-light border-0">
        <ul class="list-unstyled">
          <li class="mb-3">1.商品經查證是經由人為的破壞。</li>
          <li class="mb-3">2.超過七天的鑑賞期。</li>
          <li class="mb-3">3.食品在非瑕疵、沒有其它問題的情況下被開封或是食用。</li>
        </ul>
      </div>
    </div>
  </div>
  <hr class="mt-1">
  <div class="row">
    <h3 class="d-flex text-primary" data-bs-toggle="collapse" data-bs-target="#status2" role="button">
      退換貨需知
      <button class="btn btn-primary ms-auto" type="button" >
        +
      </button>
    </h3>
    <div class="collapse show" id="status2">
      <div class="card card-body bg-light border-0">
        <ul class="list-unstyled">
          <li class="mb-3">1.退換貨之商品必須是全新的未拆封。</li>

          <li class="mb-3">2.商品本身有瑕疵而退換貨者，如果經查證是人為破壞恕不接受退換貨(包含退款)。</li>
          
          <li class="mb-3">3.如收到當天發現瑕疵，請上網填寫退換貨表單以便處理退換貨。</li>
          
          <li class="mb-3">4.換貨必需更換同一商品及數量，或將原訂單以退貨處理並重新下訂單。</li>
          
          <li class="mb-3">5.提出商品有瑕疵或問題時，請買家們拍攝商品的問題點，並且把圖片寄至 service@yangfarmmarket.com信箱，並註明您的訂單編號，以便於確認。</li>
          
          <li class="mb-3">6.為保障商品換貨安全，請您至本站填寫退換貨表單，提出商品換退貨需求，當我們了解商品問題所在後會進一步幫您辦理換貨。</li>
          
          <li class="mb-3">7.退換貨的商品皆由黑貓宅急便收送，若不通過商品鑑定則需由購買者自行負擔二次的運送費用。故請退換貨時務必確認您的商品符合退貨條件。</li>
        </ul>
      </div>
    </div>
  </div>
  <hr class="mt-1">

</section>



@endsection

