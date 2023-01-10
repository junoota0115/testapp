@extends('layouts.app')

@section('title', '編集')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit Form</h1>
            <form action="{{route('update')}}" method="post" onSubmit="return checkSubmit()">
                @csrf

                <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product_name" value="{{ $product->product_name }}">
                    @if($errors->has('product_name'))
                    <p>{{$errors->first('product_name')}}</p>
                    @endif
                  </div>

                <div class="form-group">
                    <label for="price">金額</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ $product->price }}">
                    @if($errors->has('price'))
                    <p>{{$errors->first('price')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="stock">在庫</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{ $product->stock }}">
                    @if($errors->has('stock'))
                    <p>{{$errors->first('stock')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="Comment" >{{ $product->comment }}</textarea>
                    @if($errors->has('comment'))
                    <p>{{$errors->first('comment')}}</p>
                    @endif
                </div>

                    <a class="btn btn-secondary" href="{{route('Products')}}">キャンセル</a>

                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
    <script>
        function checkSubmit(){
            if(window.confirm('更新してよろしいですか？'))
            {
                return true;
            }else{
                return false;
            }
        }
</script>
@endsection