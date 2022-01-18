<!-- 進度條 -->
<div class="row no-gutters">
  <div class="col position-relative step ">
    <span class="bg-success rounded-circle step__circle"> 1 </span>
    <p>step1</p>
    <div class="progress">
      <div style="width: @if($step  > 1) 100% @elseif($step === 1) 30% @else 0% @endif" class="progress-bar bg-success" role="progressbar"></div>
    </div>
  </div>
  <div class="col position-relative step ">
    <span class="@if($step >=2) bg-success @endif rounded-circle step__circle"> 2 </span>
    <p>step2</p>
    <div class="progress">
      <div  style="width: @if($step  > 2) 100% @elseif($step === 2) 30% @else 0% @endif" class="progress-bar bg-success" role="progressbar"></div>
    </div>
  </div>
  <div class="col position-relative step ">
    <span class="@if($step >= 3) bg-success @endif  rounded-circle step__circle"> 3 </span>
    <p>step3</p>
    <div class="progress">
      <div style="width: @if($step  > 3) 100% @elseif($step === 3) 30% @else 0% @endif" class="progress-bar bg-success" role="progressbar"></div>
    </div>
  </div>
  <div class="col position-relative step ">
    <span class="@if($step >=4) bg-success @endif  rounded-circle step__circle"> 4 </span>
    <p>step4</p>
  </div>

</div>