@extends('layouts.app')

@section('content')

<div class="container">
<div style="background-color: lightgray;" class="border border-secondary">
    @auth
    @if (auth()->user()->role === 1)
    <div class="row justify-content-center h-50">
        <div class="col-md-6">
            <div class="p-3 w-3">
                <div class="bg-info text-white border border-secondary">
                    <p class="text-center fs-1">一般社員新規登録</p>
                    <div class="text-center">
                        <a class="link-warnimg" href= "{{route('create.employee')}}" >新規登録</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3">
                <div class="bg-info text-white border border-secondary">
                    <p class="text-center">商品新規登録</p>
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
                <div class="bg-info text-white border border-secondary">
                    <p class="text-center">在庫閲覧</p>
                    <div class="text-center"><a  href= "{{route('stock.page')}}" class="link-warning">閲覧</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3">
                <div class="bg-info text-white border border-secondary">
                    <p class="text-center">入荷情報閲覧</p>
                    <div class="text-center"><a href="{{route('arrive.page')}}" >閲覧</a></div>
                </div>
            </div>
        </div>    

    </div>

</div>
</div>

@endsection