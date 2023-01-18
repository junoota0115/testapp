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
        $products = Product::orderBy('created_at', 'asc')->where(function ($query) {

            // 検索機能
            if ($search = request('search')) {
                $query->where('product_name', 'LIKE', "%{$search}%");
            }

            
        })->paginate(20);

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
        $inputs = $request->all();

        if(isset($inputs['img_path'])){
            $file = $request->file('img_path');
            $extension = $file->getClientOriginalName();
            $inputs['img_path'] = $extension;
            $file->move('storage',$extension);
        }

        // $image = $request->file('img_path');
        
        // if($request->hasFile('img_path')){
        //     $path = $image->store('public');
        //     $request->img_path=$path;
        //     // $path = \Storage::put('/public',$image);
        //     $path = explode('/',$path);
        // }else{
        //     $path = null;
        // }
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
    
/*===========================*/
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

    //更新登録===========================
    public function exeUpdate(ProductRequest $request) {
        $inputs = $request->all();

        //トランザクション開始
        DB::beginTransaction();

        try{
            //登録で処理呼び出し
            $product = Product::find($inputs['id']);
            $product->fill([
                'company_id' => $inputs['company_id'],
                'product_name' => $inputs['product_name'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'img_path' => $inputs['img_path'],
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

    /*===========================*/
    /**
     * 商品削除
     * @param int $id
     * @return view
     */
    public function showDelete($id){
        
        if (empty($id)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('Products'));
        }
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
