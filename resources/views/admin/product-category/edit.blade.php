@extends('layouts.app')


@section('main')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">首頁</a></li>
            <li class="breadcrumb-item"><a href="/admin/news">最新消息管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增消息</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">產品類別 - 編輯</h2>

                <div class="card-body">
                    <form id="updateFrom" method="POST" action="{{ route('admin.product-categories.update', ['product_category'=> $productCategory->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH ')
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">標題1</label>
                            <div class="col-sm-10">
                                <input value="{{$productCategory->name}}" type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button id="updateFromBtn" type="submit" class="btn btn-primary">更新</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


