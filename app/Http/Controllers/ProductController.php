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
            $product = new Product();
            $product->registProduct($request);
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
    

    /**
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

    //更新登録
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
