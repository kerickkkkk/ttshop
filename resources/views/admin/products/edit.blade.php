@extends('layouts.app')
@section('css')
<style>
    img{
        max-width: 100%;
    }
    .img{
        max-width: 200px;
        height: 100px;
        background-size: cover;
        background-position: center center;
    }
</style>
@endsection

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">產品 - 修改</h2>

                <div class="card-body">
                    <form id="updateFrom" method="POST" action="{{ route('products.update', ['product'=> $product->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">標題</label>
                            <div class="col-sm-10">
                                <input value="{{$product->name}}" type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="price" class="col-sm-2 col-form-label">價格</label>
                            <div class="col-sm-10">
                                <input value="{{$product->price}}" type="text" class="form-control" id="price" name="price" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="product_cetogory" class="col-sm-2 col-form-label">分類<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="product_category_id" id="product_cetogory">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            @if ( $category->id === $product->product_category_id )
                                                selected
                                            @endif
                                            >{{ $category->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <hr>
                        <div class="form-group row py-2">
                            <label for="image" class="col-sm-2 col-form-label">主圖片</label>
                            <div class="col-sm-10">
                                <img src="{{Storage::url($product->image)}}" alt="" style="width:200px;" />
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image" class="col-sm-2 col-form-label">主圖片(重新上傳)</label>
                            <div class="col-sm-10">
                                <input value="{{Storage::url($product->image)}}" type="file" accept="image/*" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row py-2">
                            <label class="col-sm-2 col-form-label">其他圖片</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    @foreach ($product->productImages as $item)
                                        <div class="col-3">
                                            <div class="imgWrap">
                                                <div class="img position-relative" style="background-image: url({{ Storage::url($item->image) }})">
                                                    <button data-id="{{$item->id}}" type="button" class="deleteProductImage btn btn-danger 
                                                        rounded-circle position-absolute top-0 end-0">X
                                                    </button>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="images[]" class="col-sm-2 col-form-label">其他圖片(上傳)</label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="images[]" name="images[]" multiple>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row py-2">
                            <label for="content" class="col-sm-2 col-form-label">內容</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content" rows="5" required>
                                    {{$product->content}}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">詳細</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" rows="5" required>
                                    {{$product->description}}
                                </textarea>
                            </div>
                        </div>


                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button id="updateFromBtn" type="submit" class="btn btn-primary">更新</button>
                                <a href="{{route('products.index')}}" class="btn btn-outline-primary">返回列表</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function(){
        $('.deleteProductImage').on('click', function () { 
            const url = `{{route('delete-product-image')}}`
            let formData = new FormData();
            formData.append('_token','{{csrf_token()}}');
            formData.append('_method', 'DELETE')
            formData.append('id', $(this).data('id'))
        
            fetch(url,{
                method: 'POST',
                body: formData,
            }).then(res => res.json())
            .then(res => {
                if(res.msg.success) $(this).parent().parent().remove()
            })
            .catch( e => console.log(e))
        })

    })
</script>
@endsection
