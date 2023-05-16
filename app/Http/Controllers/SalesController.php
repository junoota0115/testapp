<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        
        //productのidでproductsを検索し商品があるかどうか確認
        $select_product = Product::select('products.*')
        ->where('id','=',$id)
        ->first();
        // var_dump($product_stock);
        // ->get();//配列で入ってくる

        DB::beginTransaction();
        //stockが0か確認
        try{
        if($select_product->stock <= 0) {
            echo('在庫がありません！');
        //1つでもあれば、送られてきたproductのidをsalesテーブルに追加
        }else{
           Sales::insert([
            'product_id' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //指定した商品のstockを-1してstockを更新する
        $product_stock = $select_product->stock -1;
        Product::where('id','=',$id)->update(['stock' => $product_stock]);
        echo('成功しました！');
        }
        DB::commit();
        }catch(\Throwable $e){
           \DB::rollback();
           abort(500);
        }
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