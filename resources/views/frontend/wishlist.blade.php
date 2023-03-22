@extends('layouts.front')

@section('title')
    Danh sách yêu thích
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a>/
            <a href="{{url('wishlist')}}">
               Yêu thích
            </a>

        </h6>
    </div>
</div>
    <div class="container my-5">
       <div class="card shadow wishlistitems">
        <div class="card-body">
            @if ($wishlist->count() >0)
            @foreach ($wishlist as $item)
            <div class="row product_data">
                <div class="col-md-2 my-auto">
                    <img src="{{asset('assets/uploads/products/'.$item->products->image)}}" height="70px" width="70px" alt="">
                </div>
                <div class="col-md-2 my-auto">
                    <h6>{{$item->products->name}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <h6>{{$item->products->selling_price}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <input type="hidden" class="prod_id" value="{{$item->prod_id}}">
                    @if ($item->products->qty >= 1)
                    <label for="Quantity">Số lượng</label>
                    <div class="input-group text-center mb-3" style="width: 130px;">
                        <button class="input-group-text decrement-btn">-</button>
                        <input type="text" name="quantity"  class="form-control text-center qty-input" value="1">
                        <button class="input-group-text increment-btn">+</button>
                    </div>
                @else
                <h6>Hết hàng</h6>
                    @endif
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-success addToCartBtn"> <i class="fa fa-shopping-item"> </i> Thêm vào giỏ hàng</button>
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-danger remove-wishlist-item"> <i class="fa fa-trash"> </i> Xóa</button>
                </div>
            </div>
            @endforeach

            @else
                <h4>Không có sản phẩm yêu thích nào</h4>
            @endif
        </div>

       </div>
    </div>

@endsection

