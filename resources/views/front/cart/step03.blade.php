@extends('layouts.front-app')
@section('title','填寫運送資料')
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
        @include('front.cart.cart-header', ['step'=> 3])
        <hr>
        <h3>寄送資料</h3>
        <form action="{{route('carts.step03.store')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="name">姓名
              <span class="text-danger">*</span>
            </label>
            <input type="text" name="name" class="form-control" id="name" placeholder="小楊" required>
          </div>
          <div class="form-group">
            <label for="phone">電話
              <span class="text-danger">*</span>
            </label>
            <input type="tel" name="phone" class="form-control" id="phone" placeholder="0900000000" required>
          </div>
          <div class="form-group">
            <label for="email">信箱
              <span class="text-danger">*</span>
            </label>
            <input type="email" name="email" class="form-control" id="email" placeholder="yan@mail.com" required>
          </div>
          <div class="form-row">
            <div class="col-12">
              <label class="d-bl">地址
              <span class="text-danger">*</span>
              </label>
            </div>
            <div class="form-group col-12">
              <input type="text" name="address" class="form-control" placeholder="地址" required>
            </div>           
          </div>
          <button hidden  class="hideBtn"></button>
        </form>
        <hr>
        @include('front.cart.cart-footer-total')
        <hr>
        <div class="d-flex justify-content-between py-3">
          <a href="{{route('carts.step02.index')}}" class="btn btn-outline-primary">上一步</a>
          <button class="payBtn btn btn-primary">
            {{session('payment') ? '前往付款' : '送出'}}
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
$('.payBtn').on('click', ()=>{
  $('.hideBtn').click();
})
</script>
@endsection