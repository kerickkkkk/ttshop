@extends('layouts.app')


@section('main')
<div class="container">
  <a href="{{route('admin.product-categories.create')}}" class="btn btn-sm btn-primary">新增產品類別</a>
  <div class="container">
    <form action="">
  
      <div class="table-responsive">
        <table id="example" class="table table-border table-striped table-hover text-center align-middle">
          <thead>
              <tr>
                  <th>分類名稱</th>
                  <th width="100">分類代表圖</th>
                  <th width="120">操作</th>
              </tr>
          </thead>
          <tbody >
            @foreach ($productCategories as $category)
              <tr>
                <td>{{$category->name}}</td>
                <td>
                  <div
                    style="background-image: url({{ Storage::url($category->image)}});
                      height:100px;
                    "
                    class="bg-cover"></div>
                </td>
                <td>
                  <div class="btn-group btn-group-sm" role="group">
                    <a href="{{route('admin.product-categories.edit', ['product_category'=> $category->id])}}" 
                      class="btn btn-sm btn-outline-primary">編輯</a>
                    <button class="btn btn-sm btn-outline-danger btn-delete" type="button"
                      data-href="{{ route('admin.product-categories.destroy',['product_category' => $category->id]) }}"
                    >刪除</button>
                </div>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
  
          </tfoot>
        </table>
      </div>
  
    </form>
  </div>
</div>
@endsection

@section('js')
<script>
  $(function(){

    $('.btn-delete').on('click', function(){
          // $(this).next().submit();
          Swal.fire({
            title: '確定要刪除嗎',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              const formData = new FormData();
              const url = $(this).data('href')
              formData.append('_token', '{{csrf_token()}}')
              formData.append('_method', 'DELETE')
              fetch(url, {
                method: 'POST',
                body: formData
              }).then(res => res.json())
              .then( ({success, message, status }) =>{
                if(success){
                  $(this).closest('tr').remove();
                }
                  Swal.fire({
                    icon: `${status}`,
                    title: `${message}`,
                  })
              })
            }
          })
        })
  })
</script>
@endsection