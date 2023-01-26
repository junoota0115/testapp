<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

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
    
    // public function getList($product_name){
    //      //productsテーブルからデータを取得
    //      $products = DB::table($this->table);
         
    //         // 検索機能
    //         if (!is_null($product_name)) {
    //             $products->where('product_name', 'LIKE', "%{$search}%");
    //         }

    //    $products = $products->paginate(20);
 
    //      return $products;
    //  }
public function getList(){
        $products = Product::all();
        $products = Product::orderBy('created_at', 'asc')->where(function ($query) {

            // 検索機能
            if ($search = request('search')) {
                $query->where('product_name', 'LIKE', "%{$search}%");
            }
            
        })->paginate(20);
        return $products;
}


public function getDetail($id){
     $product = Product::find($id);
     if (is_null($product)){
         \Session::flash('err_msg','データがありません');
         return redirect(route('Products'));
     }
     return $product;
    }

public function getSubmit(ProductRequest $request){
    $inputs = $request->all();
    
    if(isset($inputs['img_path'])){
        $file = $request->file('img_path');
        $extension = $file->getClientOriginalName();
        $inputs['img_path'] = $extension;
        $file->move('storage',$extension);
    }
    }
}
