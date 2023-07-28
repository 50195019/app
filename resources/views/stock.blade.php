@extends('layouts.app')

@section('content')

<main class="py-4">
        <div class="col-md-11 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>在庫商品一覧</h1>
                    <!-- 検索フォームここから -->
                        @auth
                        @if (auth()->user()->role === 1)
                        <div class="row justify-content-right">
                             <form action ="{{ route('stock.page') }}"  method="GET"  class="form-inline my-2 my-lg-0 ml-2">
                                <div class="form-group">
                                    <input type="text" class="form-control mr-sm-2 border border-secondary" name="keyword" id='keyword'  value="{{ $keyword }}" placeholder="店舗検索" aria-label="検索...">
                                    <button type="submit" class="btn btn-info border border-secondary">検索</button>
                                </div>
                            </from> 
                        </div>
                        @endif
                        @endauth
                </div> 

                        <!-- 在庫商品リストここから -->
                <div class="card-body">
                     <table class='table'>
                        <thead>
                            <tr class="d-flex justify-content-center text-center">
                                <th class="my-box w-25" scope='col'></th>
                                <th class="my-box w-25" scope='col'>店舗名</th>
                                <th class="my-box w-25" scope='col'>商品名</th>
                                <th class="my-box w-25" scope='col'>数量</th>
                                <th class="my-box w-25" scope='col'>重量(g)</th>
                                <th class="my-box w-25" scope='col'></th>
                            </tr>
                        </thead>
                        <input type="hidden" id="count" value="0">
                    <tbody id="content">
                                @foreach($stocks as $stock)
                                <tr class="d-flex justify-content-center w-100% text-center">
                                    <th class="my-box w-25" scope='col'><img style="object-fit:cover; width: 5rem; height: 5rem;" src="{{asset('storage/images/'.$stock->image)}}" alt=""></th>
                                    <th class="my-box w-25" scope='col'>{{ $stock['shop_id'] }}</th>
                                    <th class="my-box w-25" scope='col'>{{ $stock['stock_name'] }}</th>
                                    <th class="my-box w-25" scope='col'>{{ $stock['total_quantity'] }}</th>
                                    <th class="my-box w-25" scope='col'>{{ $stock['total_weight'] }}</th>
                                        @auth
                                        @if (auth()->user()->shop_id == $stock['shop_id'] )
                                    <th class="my-box w-25" scope='col'>
                                        <a href="{{route('delete.stock', $stock['products_id'])}}">
                                            <button class='btn btn-secondary' type = "button">削除</button>
                                         </a>
                                    </th>
                                        @else
                                    <th class="my-box w-25" scope='col'></th>
                                        @endif
                                        @endauth
                                </tr>
                                        @endforeach
                    </tbody>
                         </table>
                </div>
            </div>
        </div>
</main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(function(){
    // スクロールされた時に実行
    var count = 0;
      // スクロールされた時に実行 
    $(window).on("scroll", function () {
    // スクロール位置
        var document_h = $(document).height();              
        var window_h = $(window).height() + $(window).scrollTop();    
        var scroll_pos = (document_h - window_h) / document_h ;   //スクロールの高さ
            
        
        // 画面最下部にスクロールされている場合
        if (scroll_pos <= 10) {
            console.log(scroll_pos);
            // ajaxコンテンツ追加処理
            ajaxAddContent()
        }
    });

// ajaxコンテンツ追加処理
function ajaxAddContent() {
    // 追加コンテンツ
    var add_content = "";
    // コンテンツ件数           
    count = count + 1;
    var search = $("#keyword").val()

    // ajax処理
    $.post({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
          type: "post",
          datatype: "json",
          url: "/stock/more",
          data:{ count : count ,search : search}

    }).done(function(data){
        console.log(data);
       
        
        $.each(data[1],function(key, val){
            if(data[2] != val.shop_id){
              add_content +=
              `<tr class="d-flex justify-content-center w-100% text-center">
                <th class="my-box w-25" scope='col'><img style="object-fit:cover; width: 5rem; height: 5rem;" src="storage/images/${val.image}" alt=""></th>
                <th class="my-box w-25" scope='col'>${val.shop_id}</th>
                <th class="my-box w-25" scope='col'>${val.stock_name}</th>
                <th class="my-box w-25" scope='col'>${val.total_quantity}</th>
                <th class="my-box w-25" scope='col'>${val.total_weight}</th>
                <th class="my-box w-25" scope='col'></th>
              </tr>
              `
            }else{
                add_content +=
              `<tr class="d-flex justify-content-center w-100% text-center">
                <th class="my-box w-25" scope='col'><img style="object-fit:cover; width: 5rem; height: 5rem;" src="storage/images/${val.image}" alt=""></th>
                <th class="my-box w-25" scope='col'>${val.shop_id}</th>
                <th class="my-box w-25" scope='col'>${val.stock_name}</th>
                <th class="my-box w-25" scope='col'>${val.total_quantity}</th>
                <th class="my-box w-25" scope='col'>${val.total_weight}</th>
                <th class="my-box w-25" scope='col'>
                    <a href="/delete_stock/${val.products_id}">
                        <button class='btn btn-secondary' type = "button">削除</button>
                    </a>
                </th>
              </tr>
              `

            }
        })
        

        // 取得件数を加算してセット
        $("#content").append(add_content);
        $("#count").val(data[0]);
    }).fail(function(e){
        console.log(e);
    })
}
});
</script>