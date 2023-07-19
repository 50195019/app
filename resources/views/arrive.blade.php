@extends('layouts.app')

@section('content')

<main class="py-4">
    <div class='form'>
        <div class='pull-right'>
             <div class='col-left-5'>          
                <form action="{{route('create.arrive')}}"  enctype="multipart/form-data">
                 <button type='submit' class='btn btn-primary w-15 mt-3'>入荷予定商品登録</button>
                </form>
            </div>
        </div>        
    </div> 
        </div>
        <div class="col-md-11 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>入荷情報商品一覧</h1>
                        <div class="row justify-content-right">
                            <!-- 検索フォームここから -->
                            <form action ="{{ route('arrive.page') }}"  method="GET"  class="form-inline my-2 my-lg-0 ml-2">
                                <div class="form-group">
                                    <input type="text" class="form-control mr-sm-2" name="keyword"  value="{{ $keyword }}" placeholder="キーワードを入力" aria-label="検索...">
                                </div>
                        </div>
                        <!-- 日付検索ここから -->
                        <div class="row justify-content-right">
                            <!-- <div class='text-center'>日付検索</div> -->
                                    @csrf
                                    <input type="date" name="from" placeholder="from_date" value="{{ $from }}">
                                <span class="mx-3 text-grey">~</span>
                                    <input type="date" name="until" placeholder="until_date"  value="{{ $until }}">
                                        <button type="submit" class="btn btn-info">検索</button>
                            </form>
                            
                        </div>
                </div> 
                        <!-- 入荷商品リストここから -->
                        <div class="card-body">
                                <div class="card-body">
                                    <table class='table'>
                                        <thead>
                                            <tr>
                                                <th scope='col'>入荷日</th>
                                                <th scope='col'>商品名</th>
                                                <th scope='col'>数量</th>
                                                <th scope='col'>重量(g)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <div class= list>
                                                         @foreach($arrives as $arrive)
                                                     <form action="{{ route('confirm') }}" method = "post">
                                                            @csrf
                                                            <tr>
                                                                <th scope='col' >{{$arrive['arrive']}}</th>
                                                                    <input type="hidden"  name="name" value="{{$arrive['name']}}">
                                                                <th scope='col'>{{$arrive['name']}}</th>
                                                                    <input type="hidden"  name="quantity" value="{{$arrive['quantity']}}">
                                                                <th scope='col'>{{$arrive['quantity']}}</th>
                                                                    <input type="hidden"  name="weight" value="{{$arrive['weight']}}">
                                                                <th scope='col'>{{$arrive['weight']}}</th>
                                                                    <input type="hidden"  name="shop_id" value="{{$arrive['shop_id']}}">
                                                                <th scope='col'>
                                                                        <button class='btn btn-secondary' type = "submit">入荷確定</button></th>
                                                             </tr>
                                                                <input type="hidden"  name="products_id" value="{{$arrive['products_id']}}">
                                                                <input type="hidden"  name="id" value="{{$arrive['id']}}">

                                                     </form>
                                                        @endforeach
                                        </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                   
            </div>
        </div>
</main>

@endsection