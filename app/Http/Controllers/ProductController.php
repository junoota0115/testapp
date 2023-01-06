<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ブログ一覧表示
     * 
     * @return view
     */
    public function showList(){
        $products = Product::all();

        return view('product.list',['products' => $products]);
    }
}
