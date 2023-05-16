<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;
use Carbon\Carbon;

class SalesController extends Controller
{
    
    public function store()
    {

    }
    //========== update api ==========
    public function update($id)
    {
        //送られてきたproductのidをsalesテーブルに追加
        
        //productのidでproductsを検索しstockが0かどうか確認
        $product_stock = Product::select('products.*')
        ->where('id','=',$id)
        ->first();
        // var_dump($product_stock);
        // ->get();//配列で入ってくる
        
        //1つでもあれば、-1してstockを更新する
        if($product_stock->stock <= 0) {
            echo('在庫がありません！');
        }else{
           Sales::insert([
            'product_id' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
           $stock = $product_stock->stock -1;
           Product::where('id','=',$id)->update(['stock' => $stock]);
           echo('成功しました');        }

    }
    //========== update api ==========

    //===========index==========
        public function index(){
            $sales = Sales::all();
            return response()->json($sales);
        }
        public function show(){

        }


}
// $product_stock = Product::where('id','=',$sales_id)->where('stock');
// dd($product_stock);