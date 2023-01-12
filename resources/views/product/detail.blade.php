@extends('layouts.app')
@section('title', '商品詳細')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
  <tr>
  <img src="{{ '/storage/' . $product['img_path']}}" class='w-100 mb-3'/>
  <td>{{ $product->id}}</td>
  <td>商品名:{{
        $product->product_name}}</td>
        <td>金額:{{
          $product->price}}</td>
        <td>在庫:{{
          $product->stock}}</td>
        <p>{{ $product->comment}}</p>
        <td><button type="button" class="btn btn-primary" onclick="location.href='/testapp/public/product/edit/{{$product->id }}'">編集</button></td>
        <a class="btn btn-secondary" href="{{route('Products')}}">戻る</a>
        </tr>
  </div>
</div>
@endsection