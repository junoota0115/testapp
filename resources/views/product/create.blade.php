@extends('layouts.app')

@section('title', '投稿画面')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Post Form</h1>
            <form action="{{route('submit')}}" method="POST" enctype="multipart/form-date" onSubmit="return checkSubmit()">
                @csrf


                <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product_name" value="{{ old('product_name') }}">
                    @if($errors->has('product_name'))
                    <p>{{$errors->first('product_name')}}</p>
                    @endif
                  </div>

                <div class="form-group">
                    <label for="price">金額</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ old('price') }}">
                    @if($errors->has('price'))
                    <p>{{$errors->first('price')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="stock">在庫</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{ old('stock') }}">
                    @if($errors->has('stock'))
                    <p>{{$errors->first('stock')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="Comment"></textarea>
                </div>

                <div class="form-group">
                    <label for="img_path">画像保存</label>
                    <input type="file" class="form-control-file" id="img_path" name="img_path" >
                </div>

                    <a class="btn btn-secondary" href="{{route('Products')}}">キャンセル</a>

                <button type="submit" class="btn btn-primary">送信</button>
            </form>
        </div>
    </div>
@endsection