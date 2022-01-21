@extends('layouts.app')


@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">最新消息類別 - 編輯</h2>

                <div class="card-body">
                    <form id="updateFrom" method="POST" action="{{ route('admin.event-categories.update', ['event_category'=> $eventCategory->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH ')
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">標題1</label>
                            <div class="col-sm-10">
                                <input value="{{$eventCategory->name}}" type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button id="updateFromBtn" type="submit" class="btn btn-primary">更新</button>
                                <a href="{{route('admin.event-categories.index')}}" class="btn btn-outline-primary">返回列表</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


