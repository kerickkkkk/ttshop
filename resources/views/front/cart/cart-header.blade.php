<!-- 進度條 -->
<div class="row no-gutters pt-5">
  <div class="col position-relative step">
    <span class="bg-success rounded-circle p-2 text-white"> 1 </span>
    <p>購物車</p>
    <div class="progress">
      <div style="width: @if($step  > 1) 100% @elseif($step === 1) 30% @else 0% @endif" class="progress-bar bg-success" role="progressbar"></div>
    </div>
  </div>
  <div class="col position-relative step">
    <span class="@if($step >=2)  text-white bg-success @endif rounded-circle p-2"> 2 </span>
    <p>確認付款<br>運輸方式</p>
    <div class="progress">
      <div  style="width: @if($step  > 2) 100% @elseif($step === 2) 30% @else 0% @endif" class="progress-bar bg-success" role="progressbar"></div>
    </div>
  </div>
  <div class="col position-relative step">
    <span class="@if($step >= 3)  text-white bg-success @endif  rounded-circle p-2"> 3 </span>
    <p>付款</p>
    <div class="progress">
      <div style="width: @if($step  > 3) 100% @elseif($step === 3) 30% @else 0% @endif" class="progress-bar bg-success" role="progressbar"></div>
    </div>
  </div>
  <div class="col position-relative step">
    <span class="@if($step >=4)  text-white bg-success @endif  rounded-circle p-2"> 4 </span>
    <p>訂單確認</p>
  </div>

</div>