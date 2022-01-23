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
            <label for="name">姓名</label>
            <input type="text" name="name" class="form-control" id="name" value="王小明" placeholder="王小明">
          </div>
          <div class="form-group">
            <label for="phone">電話</label>
            <input type="tel" name="phone" class="form-control" id="phone" value="0123456789" placeholder="0123456789">
          </div>
          <div class="form-group">
            <label for="email">信箱</label>
            <input type="email" name="email" class="form-control" id="email" value="abc123@gmail.com" placeholder="abc123@gmail.com">
          </div>
          <div class="form-row">
            <div class="col-12">
              <label class="d-bl">地址</label>
            </div>
            <div class="form-group col-12">
              <input type="text" name="address" class="form-control" value="地址地址地址地址地址地址地址" placeholder="地址">
            </div>           
          </div>
          <button hidden  class="hideBtn"></button>
        </form>
        <hr>
        @include('front.cart.cart-footer-total')
        <hr>
        <div class="d-flex justify-content-between py-3">
          <a href="{{route('carts.step02.index')}}" class="btn btn-outline-primary">上一步</a>
          <button class="payBtn btn btn-primary">前往付款</button>
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