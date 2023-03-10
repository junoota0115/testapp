@extends('layouts.app')
@section('title', '商品一覧')

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h2>ブログ記事一覧</h2>
    <form class="form-inline my-2 my-lg-0 ml-2">
      <div class="form-group">
      <input type="search" class="form-control mr-sm-2" name="search" id="search" value="{{request('search')}}" placeholder="商品名を入力" aria-label="検索...">
      <!-- <input type="text" class="form-control mr-sm-2" name="upper"  value="{{request('upper')}}" placeholder="上限金額を入力" aria-label="検索...">
      <input type="text" class="form-control mr-sm-2" name="lower"  value="{{request('lower')}}" placeholder="下限金額を入力" aria-label="検索..."> -->
      </div>
      

      <button type="submit" id="submit"  class="btn btn-info" value="aaa">ボタン</button>
  </form>

    @if(session('err_msg'))
      <p class="text-anger">
        {{session('err_msg')}}
      </p>
      @endif
      @auth
    <a class="nav-item nav-link" href="{{route('create')}}">新規追加</a>
    @endauth
      <table>
    <thead>
        <tr>
            <th>ID </th>
            <th>NAME </th>
            <th>PRICE </th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
        
            <td>{{ $product->id }}</td>
            <td><a href="/testapp/public/product/{{$product->id }}">{{ $product->product_name }}</a></td>
            <td>{{ $product->price }}</td>
            @auth
            <td><a href="{{route('delete',$product->id)}}" class="btn btn-primary" onclick=>削除</a></td>
            @endauth

        </tr>
    @endforeach
    </tbody>
</table>
      </table>
  </div>
</div>
@endsection
<script src="{{ asset('js/ajax.js') }}" defer>
  </script>
  
