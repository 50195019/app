<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Arrive;



class ArriveCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;

        $products = $product->all();

        return view('create_arrive',compact('products'));

        

        // return view('create_arrive');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //入荷予定商品の新規登録
    {
        $shop = Auth::user()->shop_id;
        $arrive = new Arrive;
        $product = new Product;
        $name = $request->name;
        $quantity = $request->quantity * 1;
        $id = $product->where('name',$name)->value('id');

        $product_weight = $product->where('name',$name)->value('weight');//商品重量の取得
        $weight = $product_weight * $quantity;

 
        $arrive->name = $request->name;
        $arrive->quantity = $request->quantity;
        $arrive->weight = $weight;
        $arrive->arrive = $request->arrive;
        $arrive->products_id = $id;
        $arrive->shop_id = $shop;
        

        
        $arrive->save();
        

        return view('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
