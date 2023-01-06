<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

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

        //商品登録画面表示
    public function showRegistForm(){
        return view('product.regist');
    }

    public function registSubmit(ProductRequest $request) {
        //トランザクション開始
        DB::beginTransaction();

        try{
            //登録で処理呼び出し
            $model = new Product();
            $model->registProduct($request);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return back();
        }
        // 処理が完了したらregistにリダイレクト
        return redirect(route('regist'));
    }
}
