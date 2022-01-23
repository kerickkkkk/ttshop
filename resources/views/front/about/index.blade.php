@extends('layouts.front-app')

@section('main')
<section class="banner vh-50 mb-5">
  <div
    class="bg-cover h-100 position-relative"
    style="background-image: linear-gradient(to bottom , rgba(255, 255, 255, 0.9), rgba(0, 0, 0, 0.8)),
      url(https://images.unsplash.com/photo-1559186057-001c5f061d68?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80);"
  >
    <h1 class="position-absolute top-50 start-50 translate-middle">關於我們</h1>
  </div>
</section>
<section class="container">
  <div class="row my-5">
    <div class="col-md-5">
      <img src="{{asset('images/index/about-1.jpeg')}}" alt="創立初衷">
    </div>
    <div class="col-md-7">
      <h2 class="text-primary">創立初衷</h2>
      <p>
        從小就在田野中長大的鄕下孩子，扣除上學的時間外，孩提的記憶中都是在田野或是三合院度過，手上拿著東西不是鉛筆或是GAME BOY，而是鐮刀跟鋤頭，眼裡看到的景色就是黃黃的一堆土，藍藍的一片天，綠綠的一畝田。
      </p>
      <p>
        最初高中離家求學，心裡不斷的竊笑，以為手中再也不用握著鐮刀或鋤頭，想不到的是，其實在心裡已經緊緊的握住，再也放不掉，大學、當兵、工作、研究所，直到目前的創業，走過一個個的大城市，走了一大圈，又回到原出生地，不斷找尋那在樹梢上的青鳥。
      </p>
      <p>
        這些年不停的來回台北與雲林，似乎在後院的芒果樹上找到那找了許久不見的青鳥，於是乎心裡默默的下了決定，把這幾年在外所學的知識及工作經驗，全用來實現放在心裡多年的夢想。
      </p>
      <p>
        夢想不大也不多，單純想創造出，另一個雲林農業可以選擇的生存方式，不再經過數手的交易，而是直接將農產品送到消費者面前，提高農民們的收入，穩定農村家庭的經濟，讓每一份努力都能有更合理的回饋。
      </p>
      <div class="text-end">
        <a href="{{route('index')}}" class="btn btn-primary">返回首頁</a>
      </div>
    </div>
  </div>
  <hr>

</section>



@endsection

