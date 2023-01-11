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
    public function showIndex(){
        $products = Product::all();
        return view ('product.index',['products' => $products]);
    }


    
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


    /**===========================
     * 商品登録画面表示
     * 
     * @return view
     */
    public function showCreate(){
        return view('product.create');
    }

      /**===========================
     * 商品を登録する
     * 
     * @return view
     */
    public function exeSubmit(ProductRequest $request) {
        //商品データの受け取り
        $inputs = $request->all();

        \DB::beginTransaction();
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



    //     //商品データの受け取り
    //     $inputs = $request->all();
        
    //     //トランザクション開始
    //     \DB::beginTransaction();
    //     try{
    //     //商品登録で処理呼び出し
    //         Product::submit($inputs);
    //         \DB::commit();
    //     }catch(\Throwable $e){
    //         \DB::rollback();
    //         abort(500);
    //     }

    //     \Session::flash('err_msg', '商品を登録しました');
    //     // 処理が完了したらlistにリダイレクト
    //     return redirect(route('Products'));
    // }
    

    /**===========================
     * 商品編集画面表示
     * @param int $id
     * @return view
     */
    public function showEdit($id){
        $product = Product::find($id);

        if (is_null($product)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('Products'));
        }
        return view ('product.edit',['product' => $product]);
    }

    //更新登録===========================
    public function registUpdate(ProductRequest $request) {
        $inputs = $request->all();

        //トランザクション開始
        DB::beginTransaction();

        try{
            //登録で処理呼び出し
            $product = Product::find($inputs['id']);
            $product->fill([
                'product_name' => $inputs['product_name'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
            ]);
            $product->save();
            DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
        // 処理が完了したらregistにリダイレクト
        \Session::flash('err_msg','更新しました。');
        return redirect(route('Products'));
    }
}
