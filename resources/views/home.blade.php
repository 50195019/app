@extends('layouts.app')

@section('content')

<div class="container">
<div style="background-color: lightgray;">
    @auth
    @if (auth()->user()->role === 1)
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="p-3">
                <div class="bg-info text-white">
                    <p class="text-center">一般社員新規登録</p>
                    <div class="text-center">
                        <a href= "{{route('create.employee')}}" >新規登録</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3">
                <div class="bg-info text-white">
                    <p class="text-center">商品新規登録/削除</p>
                    <div class="text-center"><a href= "{{route('create.product')}}">新規登録</a></div>
                </div>
            </div>
        </div>    
    </div>
    @endif
    @endauth

    <div class="row justify-content-center">
    <div class="col-md-6">
            <div class="p-3">
                <div class="bg-info text-white">
                    <p class="text-center">在庫閲覧</p>
                    <div class="text-center"><a href= "{{route('stock.page')}}">閲覧</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3">
                <div class="bg-info text-white">
                    <p class="text-center">入荷情報閲覧</p>
                    <div class="text-center"><a href="{{route('arrive.page')}}" >閲覧</a></div>
                </div>
            </div>
        </div>    

    </div>

</div>
</div>

@endsection