@extends('layouts.app')
@section('title', '商品一覧')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h2>ブログ記事一覧</h2>
    @if(session('err_msg'))
      <p class="text-anger">
        {{session('err_msg')}}
      </p>
      @endif
    <a class="nav-item nav-link" href="{{route('create')}}">新規追加</a>
      <table>
    <thead>
        <tr>
            <th>ID </th>
            <th>NAME </th>
            <th>PRICE </th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><a href="/testapp/public/product/{{$product->id }}">{{ $product->product_name }}</a></td>
            <td>{{ $product->price }}</td>
            <td><button type="button" class="btn btn-primary" onclick="location.href='/testapp/public/product/edit/{{$product->id }}'">編集</td>
        </tr>
    @endforeach
    </tbody>
</table>
          
      </table>
  </div>
</div>
@endsection
  
