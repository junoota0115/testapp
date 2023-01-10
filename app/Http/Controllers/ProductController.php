<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * 商品一覧表示
     * 
     * @return view
     */
    public function showList(){
        $products = Product::all();
        return view ('product.list',['products' => $products]);
    }


    // /**
    //  * 商品一覧表示
    //  * 
    //  * @return view
    //  */
    // public function showList(){
    //     //インスタンス生成
    //     $model = new Product();
    //     $products = $model->getList();
    //     return view('product.list',['products'=>$products]);
    // }
    
    /**
     * 商品詳細表示
     * @param int $id
     * @return view
     */
    public function showDetail($id){
        $product = Product::find($id);

        if (is_null($product)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('Products'));
        }
        return view ('product.detail',['product' => $product]);
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
        return redirect(route('Products'));
    }


    // public function registSubmit(Request $request){
    //     //商品データを受け取る
    //     $inputs = ($request->all());
    //     //商品の登録
    //     Product::regist($inputs);
    //     \Session::flash('err_msg','登録が完了しました。');
    //     return redirect(route('products'));
    // }
    
}
