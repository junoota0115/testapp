<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Kyslik\ColumnSortable\Sortable; 

class Product extends Model
{
    
    // テーブル名
    protected $table = 'products';
    protected $fillable = [
        'company_id',
        'product_name',
        'price','stock',
        'comment',
        'img_path'
    ];
    
//商品一覧表示
public function getList(){

        $products = Product::all();
        $products = Product::orderBy('created_at', 'asc')->where(function ($query) {
        
            // 検索機能
            // if ($search = request('search')) {
            //     $query->where('product_name', 'LIKE', "%{$search}%");
            // }

            // if($upper = request('upper')){
            //     $query->where('price','>=',$upper);
            // }

            // if($lower = request('lower')){
            //     $query->where('price','<=',$lower);
            // }
            
        })->paginate(20);
        return $products;
}



//商品詳細表示
public function getDetail($id){
     $product = Product::find($id);
     if (is_null($product)){
         \Session::flash('err_msg','データがありません');
         return redirect(route('Products'));
     }
     return $product;
    }

    //商品登録
public function getSubmit(ProductRequest $request){
    $inputs = $request->all();
    // dd($inputs);
    if(isset($inputs['img_path'])){
        $file = $request->file('img_path');
        $extension = $file->getClientOriginalName();
        $inputs['img_path'] = $extension;
        $file->move('storage',$extension);
    }

    
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
    }

    //商品編集画面表示
    public function getEdit($id){
        $product = Product::find($id);

        if (is_null($product)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('Products'));
        }
        return $product;
    }

    //商品編集
    public function getUpdate(ProductRequest $request) {
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
                'comment' => $inputs['comment'],
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
    }

    // //商品削除
    // public function getDelete($id){
    //     if (empty($id)){
    //         \Session::flash('err_msg','データがありません');
    //         return redirect(route('Products'));
    //     }
    //     try{
    //         //商品削除
    //         Product::destroy($id);
    //     }catch(\Throwable $e){
    //         abort(500);
    //     }
    //     \Session::flash('err_msg','データを削除しました');
    // }
}
