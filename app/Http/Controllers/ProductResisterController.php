<?php

namespace App\Http\Controllers;

use App\Article;
Use App\Product;
use App\Stock;
use Illuminate\Http\Request;

class ProductResisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//トップページ、投稿一覧　
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()//新規登録表示
    {
        return view('product_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//新規登録を保存
    {
        $product = new Product;

        $product->name = $request->name;
        $product->weight = $request->weight;
        $product->timestamps = false;

        $original = request()->file('image')->getClientOriginalName();
        $name =date('Ymd_His').'_'.$original;
        request()->file('image')->move('storage/images',$name);
        $product->image = $name;
        
        $product->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)//商品情報の編集
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)//編集した商品情報の上書き
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)//削除
    {
        //
    }
}
