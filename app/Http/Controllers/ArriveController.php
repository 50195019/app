<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Arrive;
use App\Stock;
use App\Product;

use Illuminate\Support\Facades\Auth;


class ArriveController extends Controller
{
    public function arrivePage(Request $request){

        // 検索機能実装
        $from = $request->input('from');
        $until = $request->input('until');
        $keyword = $request->input('keyword');
        $arrive = Arrive::query();

        $shop = Auth::user()->shop_id;

        if(!empty($keyword)) {
            $arrive->where('name', 'LIKE', "%{$keyword}%");
        }
        if(isset($from) && isset($until)) {
            $arrive->whereBetween("arrive", [$from, $until]);
        }

         //テーブル内容取得

        $arrives = $arrive->where('shop_id',$shop)->get();

        return view('arrive',compact('arrives','keyword', 'from', 'until'));
                
    }

    //入荷確定登録
    public function confirm(Request $request){
        $stock = new Stock;
        $arrive = new Arrive;
        $name = $request->name;
        $id = $request->id;

        $product = Product::where('name',$name)->value('image');
        $shop_id = $arrive->where('name',$name)->value('shop_id');

        $stock->stock_name = $request->name;
        $stock->weight = $request->weight;
        $stock->quantity = $request->quantity;
        $stock->image = $product;
        $stock->shop_id = $shop_id;
        $stock->products_id = $request->products_id;
        $stock->timestamps = false;

        $stock->save();
        $arrive->find($id)->delete();


        return view('home');




    }
}
