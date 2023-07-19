@extends('layouts.app')

@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>商品新規登録</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                    <form action="{{ route('create.product')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for='name'>商品名</label>
                                <input type='text' class='form-control' name='name' value=>
                            <label for='weight' class='mt-2'>重量</label>
                                <input type='text' class='form-control' name='weight' id='date' value=>
                            <label for='image' class='mt-2'>画像</label>
                                <input type='file' name='image' accept=".jpg,.png,.JPEG,.PNG" >

                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                            </div> 


                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
