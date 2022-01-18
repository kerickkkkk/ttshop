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

<div class="p-5 bg-secondary">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">購物車</h2>

        @include('front.cart.cart-header', ['step'=> 1])

        <hr>
        <h3>訂單明細</h3>
        <ul id="orderList">
          @foreach ($cart as $item)
            <li class="orderList__item d-flex justify-content-between">
              <div class="orderList__item__detail d-flex align-items-center" data-product-id="{{$item->id}}">
                <button class="deleteBtn btn btn-sm mr-3 btn-outline-danger rounded-circle">X</button>
                <img src="{{ Storage::url($item->attributes->image)}}" alt="" class="rounded-circle order__img mr-2">
                <div>
                  <h4 class="h6 mb-0">{{$item->name}}</h4>
                  <span class="text-muted">#6554</span>
                </div>
              </div>
              <div class="orderList__item__price d-flex">
                <div class="inputGroup d-flex align-items-center" data-product-id="{{$item->id}}">
                  <button class="caculate_btn inputGroup__button btn" data-type="minus"> - </button>
                  <input readonly min="1" value="{{$item->quantity}}" class="qty form-control" type="number">
                  <button class="caculate_btn inputGroup__button btn" data-type="plus"> + </button>
                </div>
                <div class="totalPrice d-flex align-items-center" data-single="{{$item->price}}">
                  ${{number_format($item->quantity * $item->price)}}
                </div>
              </div>
            </li>
          @endforeach
          
        </ul>
        @include('front.cart.cart-footer-total')

        <div class="d-flex justify-content-between py-3">
          <a href="{{route('products.index')}}" class="btn btn-link">返回購物</a>
          <a href="{{route('carts.step02.index')}}" class="btn btn-primary">下一步</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>

const caculateMap = {
  minus: -1, 
  plus: 1
}

$('.caculate_btn').each(function (index, element) {
  $(element).on('click', caculateOrder)
});

$('.deleteBtn').each(function(i,ele){
  $(ele).on('click', deleteOrderItem)
})


//////////////////
function caculateOrder(){
  const type = $(this).data('type') ;
  const currentQty = $(this).siblings('.qty').val()
  let qty = Number(currentQty)

  qty += Number(caculateMap[type])
  if(qty <= 1) qty = 1
  console.log(qty);

  //////
  let formData = new FormData();
  const url = "{{route('carts.update')}}";
  const id = $(this).parent().data('productId')
  formData.append('id', id);
  formData.append('_token', '{{csrf_token()}}');
  formData.append('qty', qty);

  // 更新購物車
  fetch(url, {
    method: 'POST',
    body: formData
  }).then(res=>res.json())
  .then(res=>{
    console.log(res);
    if(res.quantity){
      $(this).siblings('.qty').val(res.quantity)
    }
    caculateTotal(this, qty)
  })
}

function deleteOrderItem(){

  let formData = new FormData();
  const url = "{{route('carts.destroy')}}";
  const id = $(this).parent().data('productId')
  formData.append('id', id);
  formData.append('_method', 'DELETE');
  formData.append('_token', '{{csrf_token()}}');

  // 更新購物車
  fetch(url, {
    method: 'POST',
    body: formData
  }).then(res=>res.text())
  .then(res=>{
    $(this).closest('li').remove()
    caculateTotal(this, qty = 0)
  })
}

function caculateTotal(dom, qty){
  if(qty > 0){
    const totalPrice = $(dom).parent().next().data('single') * qty
    $(dom).parent().siblings('.totalPrice').text(`\$${totalPrice.toLocaleString()}`)
  }
  caculateAllPrice()

}

function caculateAllPrice(){
  let qty = 0;
  let subTotal = 0;
  let shipping = 0;
  let total = 0;
  $('.orderList__item').each((i,ele) => {
    const itemQty = Number($(ele).find('.qty').val())
    qty += itemQty
    subTotal += $(ele).find('[data-single]').data('single') * itemQty 
  })

  $('#totalQty').text(qty);
  $('#subTotal').text( `\$${(subTotal + shipping).toLocaleString()}`)
  $('#total').text( `\$${(subTotal + shipping).toLocaleString()}`)
}

caculateAllPrice()
</script>
@endsection