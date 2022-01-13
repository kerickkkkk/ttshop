@extends('layouts.app')
{{-- @section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />
<style>
    .note-btn.dropdown-toggle:after {
        content: none;
    }

</style>
@endsection --}}

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">產品 - 新增</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">標題 <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input value="麻辣花生" type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="product_cetogory" class="col-sm-2 col-form-label">分類<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="product_category_id" id="product_cetogory" required>
                                    <option value="" hidden>請選擇分類</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="image" class="col-sm-2 col-form-label">主圖片<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="image" name="image" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="images[]" class="col-sm-2 col-form-label">其他圖片</label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="images[]" name="images[]" multiple>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="price" class="col-sm-2 col-form-label">價格<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input  value="100" type="number" min="0" class="form-control" id="price" name="price" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="content" class="col-sm-2 col-form-label">內容<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content">
                                    123
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">詳細</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" required>
                                    123
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">新增</button>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            callbacks: {
                onImageUpload: function(files) {
                    let url = "{{route('tool.image_upload')}}";

                    let formData = new FormData();
                    formData.append('_token', '{{csrf_token()}}' );
                    formData.append('img', files[0]);

                    fetch(
                        url,{
                            method:'POST',
                            body: formData
                        }
                    ).then(function(res){
                        return res.text()
                    }).then(function(res){
                        $('#description').summernote('insertImage', res)

                    })
                    // $summernote.summernote('insertNode', imgNode);
                }
            }
        });
    });
</script> --}}
@endsection
