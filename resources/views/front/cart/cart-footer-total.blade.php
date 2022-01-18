<div class="orderFooter">

  <div class="d-flex justify-content-end">
    <div class="w-25">
      <div class="d-flex justify-content-between">
        <span>數量:</span>
        <span id="totalQty" class="font-weight-bold">
          {{number_format( $totalQty ?? Cart::getTotalQuantity() )}}
        </span>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-end">
    <div class="w-25">
      <div class="d-flex justify-content-between">
        <span>小計:</span>
        <span id="subTotal" class="font-weight-bold">
          $ {{number_format( $subTotal ?? \Cart::getSubTotal() )}}
        </span>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-end">
    <div class="w-25">
      <div class="d-flex justify-content-between">
        <span>運費:</span>
        <span id="shipment" class="font-weight-bold">
          ${{number_format(60)}}
        </span>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-end">
    <div class="w-25">
      <div class="d-flex justify-content-between">
        <span>總計:</span>
        <span id="total" class="font-weight-bold">
          ${{ 
            number_format( 
              ($subTotal ?? \Cart::getTotal()  ) + 60
            ) 
          }}
          {{-- ${{ 
            number_format( 
              $subTotal ? $subTotal + 60  : (\Cart::getTotal() > 0 ?  \Cart::getTotal() + 60 : 0 )
            ) 
          }} --}}
        </span>
      </div>
    </div>
  </div>
</div>