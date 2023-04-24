<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\Product;
use Illuminate\Http\Request;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $product_id = Sales::first();
            $result = [
                'result' => true,
                'product_id' => $product_id->product_id,
            ];
            // dd($result);
        }catch(\Exception $e){
            $result = [
                'result' => false,
                'error' =>[
                    'messages' => [$e->getMessage()]
                ],
            ];
            return $this->resConversionJson($result,$e->getCord());
        }
        return $this->resConversionJson($result);
        //
    }

    private function resConversionJson($result,$statusCode=200){
        if(empty($statusCode)||$statusCode<100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result,$statusCode,['Content-Type' => 'application/json'],JSON_UNESCAPED_SLASHES);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
