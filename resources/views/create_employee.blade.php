@extends('layouts.app')

@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>社員登録</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                    <form action="{{ route('register')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for='name'>社員名</label>
                                <input type='text' class='form-control' name='name' value=>
                            <label for=''>店舗</label>
                            <select name='shop_id' class='form-control'>
                                <option value='' hidden>店舗</option>
                                @foreach($shops as $shop)

                                    <option>{{ $shop['shop_name']}}</option>
                                @endforeach
                            </select>
                            <label for='email' >メールアドレス</label>
                                <input type='email' class='form-control' name='email'>
                            <label for='password' >パスワード</label>
                                <input type='password' class='form-control' name='password' value=>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                            </div> 


                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
