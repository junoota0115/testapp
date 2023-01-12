@extends('layouts.app')
@section('title', '商品詳細')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <img scr="{{ '/storage/' . $product['img_path']}}" class='w-100 mb-3'/>
      <h2>{{ $product->id}}</h2>
      <span>商品名:{{
        $product->product_name}}</span>
        <span>金額:{{
          $product->price}}</span>
        <span>在庫:{{
          $product->stock}}</span>
        <p>{{ $product->comment}}</p>
     
  </div>
</div>
@endsection