<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**==========================
     * 商品一覧表示
     * 
     * @return view
     */
    public function showIndex(?String  $product_name = null ){
        $product_model = new Product();
        $products = $product_model->getList($product_name);
        // dd($products);
        
  
        return view ('product.index',['products' => $products]);
    }
    /*===========================
    検索機能サーチ*/

    public function ajaxSearch(Request $request){
        $search = $request->input('search');
        $upper = $request->input('upper');
        $lower = $request->input('lower');
        $stockUpper = $request->input('stockUpper');
        $stockLower = $request->input('stockLower');
        $query = Product::query();

        if(!empty($search)){
            $query->where('product_name','like',$search);
        }
        if(!empty($upper)){
            $query->where('price','<=',$upper);
        }
        if(!empty($lower)){
            $query->where('price','>=',$lower); 
        }
        if(!empty($stockUpper)){
            $query->where('stock','<=',$stockUpper); 
        }
        if(!empty($stockLower)){
            $query->where('stock','>=',$stockLower); 
        }
        $products = $query->get();

        return response()->json($products);
        }
        // if($search = request('search')){
        // $products = Product::where('product_name','like',"%{$request->search}%")->get();
        // }
        // if($upper = request('upper')){
        //     $products = Product::where('price','>=',$upper)->get();
        // }
        // if($lower = request('lower')){
        //     $products = Product::where('price','<=',$lower)->get();
        // }
    
        // ->orwhere('price','like',"%{$request->search}%")->get();

    
    /*===========================*/
    /**
     * 商品詳細表示
     * @param int $id
     * @return view
     */
    public function showDetail($id){
        $product_model = new Product();
        $product = $product_model->getDetail($id);
        $companies = Company::where('id','=',$product['company_id'])
        ->first();

        return view ('product.detail',['product' => $product,'companies'=>$companies]);
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

   //===========================
   /**
    * 更新登録
    */
    public function exeUpdate(ProductRequest $request) {
        $product_model = new Product();
        $products = $product_model->getUpdate($request);
    return redirect(route('Products'));
}
    /*===========================*/
    // /**
    //  * 商品削除
    //  * @param int $id
    //  * @return view
    //  */
    // public function showDelete($id){
    //     $product_model = new Product();
    //     $product_model->getEdit($id);

    //     return redirect(route('Products'));
    // }

     /*========非同期削除===================*/
     public function destroy(Request $request){
        //  dd($product);
        //  Log::info($product);  処理のログをstorageフォルダ内に保存
         $db_data = new Product;
         $db_data->destroy($request->id); 
         return response()->json(['result'=>'成功']);

     }
}


// 405エラーはリクエストされたページが実在することを（また、URLが正しく入力されたことを）
// 確認した上で、リクエストをするのに使用されたHTTPメソッドが許可されないことを意味します。