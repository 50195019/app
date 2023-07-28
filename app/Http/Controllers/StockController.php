<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use Illuminate\Support\Facades\Auth;


class StockController extends Controller
{
    public function stockPage(Request $request){
        $count = 3;

        if(Auth::user()->role === 1){
        $shop = Auth::user();
        $keyword = $request->input('keyword');
        $stock = Stock::query();

        if(!empty($keyword)) {
            $stock->where('shop_id', 'LIKE', "%{$keyword}%");
        }

        $stocks = $stock->select('stock_name','shop_id','image','products_id')
        ->selectRaw('SUM(weight) AS total_weight, SUM(quantity) AS total_quantity',)
        ->groupBy('stock_name','shop_id','image','products_id')
        ->limit($count)->get(); 

        return view('stock',compact('stocks', 'keyword','shop')
        );
        }else{
        $stock = new Stock;
        $shop = Auth::user()->shop_id;
        $shops = $stock->where('shop_id', $shop)->get();

        $stocks = $stock->select('stock_name','shop_id','image','products_id')
        ->selectRaw('SUM(weight) AS total_weight, SUM(quantity) AS total_quantity',)
        ->groupBy('stock_name','shop_id','image','products_id')->where('shop_id',$shop)
        ->limit($count)->get();
            
        return view('stock',compact('stocks')
        );
        }
    }
    public function ajaxStock(Request $request){
            $count = $request->count * 3;
            $keyword = $request->search;
            $user_id = Auth::user()->shop_id;
        if(Auth::user()->role === 1){
            $shop = Auth::user();
           
            $stock = Stock::query();
    
            if(!empty($keyword)) {
                $stock->where('shop_id', 'LIKE', "%{$keyword}%");
            }
    
            $stocks = $stock->select('stock_name','shop_id','image','products_id')
            ->selectRaw('SUM(weight) AS total_weight, SUM(quantity) AS total_quantity',)
            ->groupBy('stock_name','shop_id','image','products_id')
            ->offset($count)->limit(3)->get();
    
            $counts = $count + 3;
            return array($counts, $stocks, $user_id);

            }else{
            $stock = new Stock;
            $shop = Auth::user()->shop_id;
            $shops = $stock->where('shop_id', $shop)->get();
    
            $stocks = $stock->select('stock_name','shop_id','image','products_id')
            ->selectRaw('SUM(weight) AS total_weight, SUM(quantity) AS total_quantity',)
            ->groupBy('stock_name','shop_id','image','products_id')->where('shop_id',$shop)
            ->offset($count)->limit(3)->get();
                
            $counts = $count + 3;
            return array($counts, $stocks, $user_id);
            }

    }

    public function delete($id){
        $stock = new Stock;

        $deletes = $stock->where('products_id',$id)->first();
        $deletes->delete();

        return view('home');
    }
}


