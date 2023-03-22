@extends('layouts.front')

@section('title')
    Giỏ hàng của tôi
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('category')}}">
                Home
            </a>/
            <a href="{{url('cart')}}">
               Cart
            </a>

        </h6>
    </div>
</div>
    <div class="container my-5">
        <div class="card shadow carditems">
            @if ($cartitems->count() > 0)
            <div class="card-body">
                @php
                    $total = 0;
                @endphp
            @foreach ($cartitems as $cart)
            <div class="row product_data">
                <div class="col-md-2 my-auto">
                    <img src="{{asset('assets/uploads/products/'.$cart->products->image)}}" height="70px" width="70px" alt="">
                </div>
                <div class="col-md-3 my-auto">
                    <h6>{{$cart->products->name}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <h6>{{$cart->products->selling_price}}</h6>
                </div>
                <div class="col-md-3 my-auto">
                    <input type="hidden" class="prod_id" value="{{$cart->prod_id}}">
                    @if ($cart->products->qty >= $cart->prod_qty)
                    <label for="Quantity">Số lượng</label>
                    <div class="input-group text-center mb-3" style="width: 130px;">
                        <button class="input-group-text changeQuantity decrement-btn">-</button>
                        <input type="text" name="quantity" value={{$cart->prod_qty}} class="form-control text-center qty-input">
                        <button class="input-group-text changeQuantity increment-btn">+</button>
                    </div>
                    @php
                    $total += ((float)$cart->products->selling_price * (float)$cart->prod_qty) ;
                 @endphp
                @else
                <h6>Hết hàng</h6>
                    @endif
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"> </i> Xóa</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-footer">
            <h6>Giá tiền :{{$total}}
                <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Đặt hàng</a></h6>
        </div>
            @else
               <div class="card-body text-center">
                <h2><i class="fa fa-shopping-cart"></i> Của bạn không có mặt hàng</h2>
                <a href="{{url('category')}}" class="btn btn-outline-primary float-end">Mua hàng</a>
            </div>
            @endif

        </div>
    </div>

@endsection

