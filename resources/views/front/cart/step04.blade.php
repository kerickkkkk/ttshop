@extends('layouts.front-app')
@section('title','第四步驟')
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

<div class="p-5 bg-secondary">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">購物車</h2>
        
        @include('front.cart.cart-header', ['step'=> 4])

        <hr>
        <h1 class="text-center font-weight-bold">訂單成立</h1>
        <h3>訂單明細</h3>
        <ul id="orderList">

          @php
            $totalQty = 0;
            $subTotal = 0;
          @endphp

          @foreach ($order->orderDetails as $item)

            @php
                $totalQty += $item->qty; 
                $subTotal += $item->price * $item->qty;
            @endphp

            <li class="orderList__item d-flex justify-content-between">
              <div class="orderList__item__detail d-flex align-items-center">
                <img src="{{ Storage::url($item->image_url) }}" alt="" class="rounded-circle order__img mr-2">
                <div>
                  <h4 class="h6 mb-0">{{ $item->name }}</h4>
                  <span class="text-muted">#6554</span>
                </div>
              </div>
              <div class="orderList__item__price d-flex align-items-center">
                <div class="mr-3">x {{ $item->qty }}</div>
                <div class="price d-flex align-items-center">
                  {{ $item->price * $item->qty }}
                </div>
              </div>
            </li>
          @endforeach
        </ul>
        <h3>寄送資料</h3>
        <ul>
          <li class="d-flex py-3">
            <div class="mr-3">姓名</div>
            <div>{{$order->name}}</div>
          </li>
          <li class="d-flex py-3">
            <div class="mr-3">電話</div>
            <div>{{$order->phone}}</div>
          </li>
          <li class="d-flex py-3">
            <div class="mr-3">Email</div>
            <div>{{ $order->email }}</div>
          </li>
          <li class="d-flex py-3">
            <div class="mr-3">地址</div>
            <div>{{ $order->address }}</div>
          </li>
        </ul>

        <hr>
        @include('front.cart.cart-footer-total',[
          'step' => 4,
          'totalQty' => $totalQty,
          'subTotal' => $subTotal,
        ])

        <hr>
        <div class="text-right py-3">
          <a href="{{route('index')}}" class="btn btn-primary">返回首頁</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

