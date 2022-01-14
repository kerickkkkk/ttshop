@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('main')
  <div class="container">
    <div class="card">
      <div class="card-header">
        最新消息管理
      </div>
      <div class="card-body">
        <a href="{{ route('events.create') }}" class="btn btn-sm btn-warning">新增最新消息</a>
        <hr>
        <div class="table-responsive">
          <table id="dataTable" class="table table-border table-striped table-hover text-center align-middle">
            <thead>
                <tr>
                  <th>標題</th>
                  <th>分類</th>
                  <th width="150">日期</th>
                  <th style="width:100px;">圖片</th>
                  <th width="200">內容</th>
                  <th width="120">操作</th>
                </tr>
            </thead>
            <tbody >
              @foreach ($events as $event)
                <tr>
                  <td>{{$event->title}}</td>
                  <td>{{$eventCategories[$event->event_category_id]}}</td>
                  <td>{{$event->date}}</td>
                  <td>
                    <img src="{{Storage::url($event->image)}}" width="200" alt="">
                  </td>
                  <td>
                      {{$event->content}}
                  </td>
                  <td>
                    <a href="{{route('events.edit', ['event'=> $event->id])}}" class="btn btn-sm btn-primary">編輯</a>
                    <button class="btn btn-sm btn-danger btn-delete">刪除</button>
                    <form class="delete-form d-none" action="{{ route('events.destroy',['event' => $event->id]) }}" method="POST">
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
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==' crossorigin='anonymous'></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable();
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
      } );
    </script>
@endsection