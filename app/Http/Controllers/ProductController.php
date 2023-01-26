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
    public function showIndex(?String  $product_name = null ){
        $product_model = new Product();
        $products = $product_model->getList($product_name);
  
        return view ('product.index',['products' => $products]);
    }


    
    /**
     * 商品詳細表示
     * @param int $id
     * @return view
     */
    public function showDetail($id){
        $product_model = new Product();
        $product = $product_model->getDetail($id);

        return view ('product.detail',['product' => $product]);
    }

    /*===========================*/
    /**
     * 商品登録画面表示
     * 
     * @return view
     */
    public function showCreate(){
        return view('product.create');
    }

    /*===========================*/
      /**
     * 商品を登録する
     * 
     * @return view
     */
    public function exeSubmit(ProductRequest $request) {
        //商品データの受け取り
        $product_model = new Product();
        $products = $product_model->getSubmit($request);

        try{
            //商品登録
            Product::create($inputs);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg', '商品を登録しました');
         // 処理が完了したらlistにリダイレクト
         return redirect(route('Products'));
     }
    
/*===========================*/
    /**
     * 商品編集画面表示
     * @param int $id
     * @return view
     */
    public function showEdit($id){
        $product_model = new Product();
        $product = $product_model->getEdit($id);

        return view ('product.edit',['product' => $product]);
    }

    //更新登録===========================
    public function exeUpdate(ProductRequest $request) {
        // $inputs = $request->all();

        // //トランザクション開始
        // DB::beginTransaction();
        $product_model = new Product();
        $product_model->getEdit($request);
        try{
            DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
        // 処理が完了したらregistにリダイレクト
        \Session::flash('err_msg','更新しました。');
        return redirect(route('Products'));
    }

    /*===========================*/
    /**
     * 商品削除
     * @param int $id
     * @return view
     */
    public function showDelete($id){
        $product_model = new Product();
        $product_model->getEdit($id);
        try{
            //商品削除
            Product::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        \Session::flash('err_msg','データを削除しました');
        return redirect(route('Products'));
    }
}
