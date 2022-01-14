@extends('layouts.app')
@section('css')

@endsection

@section('main')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">首頁</a></li>
            <li class="breadcrumb-item"><a href="/admin/events">最新消息管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增消息</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">最新消息 - 編輯</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('events.update' , ['event'=> $event->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row py-2">
                            <label for="title" class="col-sm-2 col-form-label">標題
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" required value="{{$event->title}}">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="event_category" class="col-sm-2 col-form-label">分類
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <select name="event_category_id" id="event_category_id" class="form-select" required>
                                    @foreach ($eventCategories as $eventCategory)
                                        <option value="{{$eventCategory->id}}"
                                            @if($eventCategory->id === $event->event_category_id) 
                                                selected 
                                            @endif
                                            >{{$eventCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="date" class="col-sm-2 col-form-label">日期
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date" name="date" required value="{{$event->date}}">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label class="col-sm-2 col-form-label">主圖片
                            </label>
                            <div class="col-sm-10">
                                <img src="{{Storage::url($event->image)}}" width="200" alt="">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image" class="col-sm-2 col-form-label">主圖片(重新上傳)
                            </label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="image" name="image">
                                <img src="" width="200" alt="">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="content" class="col-sm-2 col-form-label">內容</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content" rows="5" required >
                                    {{$event->content}}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">新增</button>
                                <a href="{{route('events.index')}}" class="btn btn-outline-primary">返回列表</a>
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
