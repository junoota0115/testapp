@extends('layouts.app')
@section('title', '商品一覧')

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h2>ブログ記事一覧</h2>
    <form class="form-inline my-2 my-lg-0 ml-2" id = "search_text">
      <div class="form-group">
      <input type="search" class="form-control mr-sm-2" name="search" id="search" value="{{request('search')}}" placeholder="商品名を入力" aria-label="検索...">
      <input type="search" class="form-control mr-sm-2" name="upper" id="upper" value="{{request('upper')}}" placeholder="上限金額を入力" aria-label="検索...">
      <input type="search" class="form-control mr-sm-2" name="lower" id="lower" value="{{request('lower')}}" placeholder="下限金額を入力" aria-label="検索...">
      <input type="search" class="form-control mr-sm-2" name="stockUpper" id="stockUpper" value="{{request('stockUpper')}}" placeholder="上限在庫を入力" aria-label="検索...">
      <input type="search" class="form-control mr-sm-2" name="stockLower" id="stockLower" value="{{request('stockLower')}}" placeholder="下限在庫を入力" aria-label="検索...">
      </div>

      <button type="button" id="button"  class="btn btn-info" value="aaa" >ボタン</button>
    </form>
    <hr>
    @if(session('err_msg'))
    <p class="text-anger">
      {{session('err_msg')}}
    </p>
    @endif
    @auth
    <div><a class="nav-item nav-link" href="{{route('create')}}">新規追加</a></div>
    @endauth
    <table>
      <thead>
        <tr>
            <th id="id">ID </th>
            <th id="product_name">商品名 </th>
            <th id="price">金額 </th>
            <th id="stock">在庫 </th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody class="index" id="index">
    @foreach ($products as $product)
        <tr>
        
            <td>{{ $product->id }}</td>
            <td><a href="/testapp/public/product/{{$product->id }}">{{ $product->product_name }}</a></td>
            <td>¥{{ $product->price }}</td>
            <td>{{ $product->stock }}個</td>
            @auth
            <td>
           <form class="id">
              <input product_id="{{$product->id}}" type="submit" class="btn btn-danger" value="TEST">
            </form>
          </td>
            @endauth

        </tr>
    @endforeach
    </tbody>
</table>
      </table>
  </div>
</div>

@endsection
<script src="{{ asset('js/ajax.js') }}" defer></script>


  
