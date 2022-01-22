@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('main')
  <div class="container">
    <div class="card">
      <div class="card-header">
        產品管理
      </div>
      <div class="card-body">
        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-warning">新增產品</a>
        <hr>
        <div class="table-responsive">
          <table id="dataTable" class="table table-border table-striped table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>標題</th>
                    <th style="width:200px;">圖片</th>
                    <th>分類</th>
                    <th>內容</th>
                    <th>價格</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
                <tr>
                  <td>{{$product->name}}</td>
                  <td>
                    <img src="{{Storage::url($product->image)}}" width="200" alt="">
                  </td>
                  <td>{{$product->productCategory->name}}</td>
                  <td>{{$product->description}}</td>
                  <td>{{$product->price}}</td>
                  <td>
                    <a href="{{route('admin.products.edit', ['product'=> $product->id])}}" class="btn btn-sm btn-primary">編輯</a>
                    <button class="btn btn-sm btn-danger btn-delete">刪除</button>
                    <form class="delete-form d-none" action="{{ route('admin.products.destroy',['product' => $product->id]) }}" method="POST">
                      @csrf
                      @method("DELETE")
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>

            </tfoot>
          </table>
        </div>
      </div>
    </div>
    
  </div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $('#dataTable').DataTable(
        {
          language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.4/i18n/zh_Hant.json"  
          } 
        }
      )
      $('.btn-delete').each(function(i,ele){
        $(ele).on('click',function () { 
          Swal.fire({
            title: '確定要刪除嗎',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OK'
          }).then((result) => {
            $(this).next().submit()
          })
        })
      })
    </script>
@endsection