@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">產品類別 - 新增</h2>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.product-categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">類別名稱<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image" class="col-sm-2 col-form-label">類別代表圖<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">新增</button>
                                <a href="{{route('admin.product-categories.index')}}" class="btn btn-outline-primary">返回列表</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
