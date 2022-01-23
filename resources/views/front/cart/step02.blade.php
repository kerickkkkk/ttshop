@extends('layouts.front-app')
@section('css')
<style>
  .step{
  display: flex;
  flex-direction: column;
  align-items: center;
    &__circle{
      width: 30px;
      height: 30px;
      margin: 0 auto;
      display: flex;
      justify-content: center;
      align-items: center;
    }  
  }
  .progress{
    position: absolute;
    width: 80%;
    height: 10px;
    top: 10px;
    right: -50%;
    transform: translate(-10%, 0);
  }
</style>
@endsection

@section('main')

<div class="p-5 bg-secondary min-vh-100">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">購物車</h2>

        @include('front.cart.cart-header', ['step'=> 2])
        
        <hr>
        <form id="step02Form" action="{{route('carts.step02.store')}}" method="post">
          @csrf
          <h4>付款方式</h3>
            <ul class="payMethod px-3">
              <li class="py-3 border-bottom">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="payment" id="blackcat" value="0" checked>
                  <label class="form-check-label" for="blackcat">信用卡付款</label>
                </div>
              </li>
              <li class="py-3 border-bottom">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="payment" id="shoptoshop" value="1">
                  <label class="form-check-label" for="shoptoshop">網路 ATM</label>
                </div>
              </li>
              <li class="py-3">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="payment" id="shoptoshopshop" value="2">
                  <label class="form-check-label" for="shoptoshopshop">超商代碼</label>
                </div>
              </li>
            </ul>
          <hr>
          <h4>運送方式</h3>
            <ul class="shipMethod px-3">
              <li class="py-3 border-bottom">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="shipment" id="shipment1" value="0" checked>
                  <label class="form-check-label" for="shipment1">黑貓宅配</label>
                </div>
              </li>
              <li class="py-3">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="shipment" id="shipment2" value="1">
                  <label class="form-check-label" for="shipment2">超商店到店</label>
                </div>
              </li>
            </ul>
          <hr>
          @include('front.cart.cart-footer-total')


          </div>
          <hr>
          <div class="d-flex justify-content-between py-3">
            <a href="{{route('carts.step01.index')}}" class="btn btn-outline-primary">上一步</a>
            <button class="next btn btn-primary">下一步</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
  $('.next').on('click',function () { 
    $('#step02Form').submit();
  })
</script>
@endsection