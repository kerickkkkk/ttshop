@extends('layouts.app')


@section('main')
<div class="container ">
  Customer Profile
  <br>
  @foreach ($orders as $order)
    訂單編號 : {{$order->order_no}}
      
  @endforeach
</div>
@endsection

@section('js')
    
@endsection