@extends('layouts.app')
@section('title', '商品詳細')
@section('content')
<div class="row" >
  <div class="col-md-8 col-md-offset-2">
  <tr>
  @if ($product->img_path !=='')
  <div><img src="{{asset('/storage/'.$product->img_path)}}" width="100" height="100"/></div>
  @else
<div><img src="{{asset('storage/no_image.png')}}" width="100" height="100"></div>
  @endif

  <td>{{ $product->id}}</td>
  <td>社名:{{
        $product->company_id}}</td>

  <td>商品名:{{
        $product->product_name}}</td>

        <td>金額:{{
          $product->price}}</td>

          <td>在庫:{{
          $product->stock}}</td>

          <p>{{ $product->comment}}</p>
        @auth
        <td><button type="button" class="btn btn-primary" onclick="location.href='/testapp/public/product/edit/{{$product->id }}'">編集</button></td>
        @endauth
        <a class="btn btn-secondary" href="{{route('Products')}}">戻る</a>
        </tr>
  </div>
</div>
@endsection

<!-- <script src="{{ asset('js/delete.js') }}" defer></script> -->