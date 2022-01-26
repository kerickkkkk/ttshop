
@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('後臺面板') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @php
                    $role = Auth::user()->role ?? null;
                    @endphp

                    @if($role === 'customer')
                        已登入
                    @elseif($role === 'admin')
                        管理介面
                        @if (isset($users))
                            @foreach ($users as $user)
                                <div class="accordion accordion-flush">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$user->id}}">
                                            {{$user->name}} 的訂單
                                        </button>
                                        </h2>
                                        <div id="flush-collapse{{$user->id}}" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <ul>
                                                    @foreach ($user->orders as $order)
                                                        <li>
                                                            {{$order->order_no}} - 訂購者 {{$order->name}} - 電話 {{$order->phone}} - email {{$order->email}}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="accordion accordion-flush">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsenouser">
                                        無使用者
                                    </button>
                                </h2>
                                <div id="flush-collapsenouser" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <ul>
                                            @if (isset($noUsers))
                                                @foreach ($noUsers as $noUser)
                                                    <li>
                                                        {{$noUser->order_no}} - 訂購者 {{$noUser->name}} - 電話 {{$noUser->phone}} - email {{$noUser->email}} - time {{$noUser->created_at}}
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
