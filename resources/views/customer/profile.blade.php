@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection
@section('main')
<div class="container">
  <h2> > 訂單列表 </h2>
  @php
    use App\Models\Order;
  @endphp
    <table id="dataTable" class="table table-striped table-sm mb-4">
      <thead class="thead-dark">
        <tr>
          <th scope="col">訂單編號</th>
          <th scope="col">日期</th>
          <th scope="col">總價</th>
          <th scope="col">是否付款</th>
          <th scope="col">付款方式</th>
          <th scope="col">運送方式</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
          <tr>
            <td>{{ $order->order_no }}</td>
            <td>{{ date_format($order->created_at, 'Y-m-d') }}</td>
            <td>
              
            </td>
            <td
              class="
                fw-bold
                @if ($order->is_paid)
                    text-success
                @else
                    text-danger
                @endif
              "

            >{{ Order::ISPAID[$order->is_paid] }}

            </td>
            <td>{{ Order::PAYMENT[$order->payment] }}</td>
            <td>{{ Order::SHIPMENT[$order->shipment] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(function(){
    $('#dataTable').DataTable(
      {
        language: {
          url: "https://cdn.datatables.net/plug-ins/1.11.4/i18n/zh_Hant.json"  
        } 
      }
    )
  })
</script>
@endsection