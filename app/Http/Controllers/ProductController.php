<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * ブログ一覧表示
     * 
     * @return view
     */
    public function showList(){
        //インスタンス生成
        $model = new Product();
        $products = $model->getList();
        return view('product.list',['products'=>$products]);
    }

        //商品登録
    public function showRegistForm(){
        return view('regist');
    }
}
