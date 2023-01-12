@extends('layouts.app')
@section('title', '商品一覧')

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-2">
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
            <td><button type="button" class="btn btn-primary" onclick="location.href='/testapp/public/product/edit/{{$product->id }}'">編集</button></td>
            <form action="{{route('delete', $product->id)}}" method="POST" onSubmit="return checkDelete()">
                @csrf
            <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
        </tr>
    @endforeach
    </tbody>
</table>
          
      </table>
  </div>
</div>
<script>
        function checkDelete(){
            if(window.confirm('削除してよろしいですか？'))
            {
                return true;
            }else{
                return false;
            }
        }
</script>
@endsection
  
