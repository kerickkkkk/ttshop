@extends('layouts.app')
@section('css')

@endsection

@section('main')
<div class="container">
    <h1>聯絡我們管理</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>姓名</th>
                <th>電話</th>
                <th>Email</th>
                <th>表單</th>
                <th with="80">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->phone}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->content}}</td>
                    <td>
                        <a class="btn btn-sm btn-danger btn-delete">刪除</a>
                        <form action="{{route('contacts.destroy', ['contact' => $contact->id])}}" class="d-none"
                                method="POST"
                            >
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script>
    $('.btn-delete').on('click',function(){
        $(this).next().submit();
    })
    


</script>
@endsection
