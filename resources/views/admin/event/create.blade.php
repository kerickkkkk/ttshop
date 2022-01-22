@extends('layouts.app')
@section('css')

@endsection

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">最新消息 - 新增</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="title" class="col-sm-2 col-form-label">標題
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input value="最新消息標題" type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="event_category_id" class="col-sm-2 col-form-label">分類
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <select id="event_category_id" name="event_category_id" class="form-select">
                                    <option disabled selected value>請選擇</option>
                                    @foreach ($eventCategories as $eventCategory)
                                        <option value="{{$eventCategory->id}}">{{$eventCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="date" class="col-sm-2 col-form-label">日期
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image" class="col-sm-2 col-form-label">圖片
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="content" class="col-sm-2 col-form-label">內容
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">新增</button>
                                <a href="{{route('admin.events.index')}}" class="btn btn-outline-primary">返回列表</a>
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

@endsection
