<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    // テーブル名
    protected $table = 'products';
    protected $fillable = ['company_id','product_name','price','stock','comment','img_path'];

    // public function getList(){
    //     //productsテーブルからデータを取得
    //     $products = DB::table('products')->get();

    //     return $products;
    // }

    // public function registProduct($date){
    //     //登録処理
    //     DB::table('products')->insert([
    //         'product_name'=> $date->product_name,
    //         'price'=> $date->price,
    //         'stock'=> $date->stock,
    //         'comment'=> $date->comment,
    //     ]);
    // }
}
