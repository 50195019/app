@extends('layouts.app')

@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>入荷予定商品登録</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                    <form action="{{route('create.arrive')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for='name'>商品名</label>
                                <select name='name' class='form-control'>
                                    <option value='' hidden>商品名</option>
                                    @foreach($products as $product)
                                        <option>{{ $product['name']}}</option>
                                    @endforeach
                                </select>
                            <label for='quantity'>数量</label>
                                <input type='number' class='form-control' name='quantity' value=>
                             <label for='arrive'>入荷予定日</label>
                                <input type='date' class='form-control' name='arrive' value=>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                            </div> 


                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
