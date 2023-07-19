@extends('layouts.app')

@section('content')

<div class="container">
<div style="background-color: lightgray;">
    <div class="row justify-content-center">
    <div class="col-md-6">
            <div class="p-3">
                <div class="bg-info text-white">
                    <p class="text-center">在庫閲覧</p>
                    <div class="text-center"><a href= >閲覧</a></div>
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