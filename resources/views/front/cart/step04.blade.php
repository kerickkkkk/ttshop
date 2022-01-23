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


<div class="p-5 bg-secondary min-vh-100">
  <div class="container">
    <div class="card">
      <div class="card-body">
        
        @include('front.cart.cart-header', ['step'=> 4])

        <hr>
        <div class="bg-light container">
          <div class="row p-4 my-5">
            <div class="col-md-6 mb-3 mb-md-0">
              <div class="row justify-content-center align-items-center h-100">
                <div class="text-center">
                  
                  <h1 class="text-success h1 mb-3"><i class="fas fa-check-circle"></i> 
                    訂購成功 
                  </h1>
                  <p class="w-75 mx-auto"> 感謝您的訂購，為您附上購買明細。如對此次交易有任何問題，請隨時聯絡我們。 </p>
                  
                  <a href="{{route('products.index')}}" class="btn btn-primary"> 返回產品列表 </a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="bg-white p-md-5 rounded">
                <h2 class="text-center border-bottom pb-3"> 購買明細 </h2>
                <table class="table table-border">
                  <tbody>
                   <tr>
                    <th>下單時間</th>
                    <td>{{$order->created_at}}</td>
                   </tr>
                   <tr>
                    <th>訂購編號</th>
                    <td>{{$order->order_no}}</td>
                   </tr>
                   <tr>
                    <th>訂購人</th>
                    <td>{{$order->name}}</td>
                   </tr>
                   <tr>
                    <th>信箱</th>
                    <td>{{$order->email}}</td>
                   </tr>
                   <tr>
                    <th>電話</th>
                    <td>{{$order->phone}}</td>
                   </tr>
                   <tr>
                    <th>地址</th>
                    <td>{{$order->address}}</td>
                   </tr>
                   <tr>
                    <th>商品清單</th>
                    <td>
                      @php
                        $totalQty = 0;
                        $subTotal = 0;
                      @endphp
                      @foreach ($order->orderDetails as $item)
        
                        @php
                            $totalQty += $item->qty; 
                            $subTotal += $item->price * $item->qty;
                        @endphp
                        <p class="mb-0 border-bottom">{{$item->name}}
                          <span class="d-flex"> ${{number_format($item->price)}} x {{$item->qty}} 個 = <span class="ms-auto">${{number_format($item->price * $item->qty)}}</span></span>
                        </p>
                        @endforeach
                        <p class="mb-0 text-end"> 總價： NT${{number_format($subTotal)}}</p>
                    </td>
                   </tr>
                   <tr>
                    <th>付款方式</th>
                    <td>
                      @php
                        use App\Models\Order;
                      @endphp
                      {{Order::PAYMENT[$order->payment]}}
                    </td>
                   </tr>
                   <tr>
                    <th>付款狀態</th>
                    <td>
                      <div class="text-{{$order->is_paid ? 'success' : 'danger'}}">
                        {{$order->is_paid ? '已付款' : '未付款'}}
                      </div>
                    </td>
                   </tr>
                  </tbody>
                 </table>
                </div>
            </div>
          </div>
        </div>

        <hr>
        <div class="text-right py-3">
          <a href="{{route('index')}}" class="btn btn-primary">返回首頁</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

