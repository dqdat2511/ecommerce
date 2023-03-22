@extends('layouts.front')

@section('title')
    Lịch sử đặt hàng
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Hàng hóa của {{Auth::user()->name}}
                        <a href="{{url('my-order')}}" class="btn btn-warning text-white float-end">Trở lại</a>
                    </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Thông tin vận chuyển</h4>
                                <hr>
                                <label for="">Họ</label>
                                <div class="border">{{ $orders->fname }}</div>
                                <label for="">Tên</label>
                                <div class="border">{{ $orders->lname }}</div>
                                <label for="">Email</label>
                                <div class="border">{{ $orders->email }}</div>
                                <label for="">Số điênj thoại</label>
                                <div class="border">{{ $orders->phone }}</div>
                                <label for="">Địa chỉ nhận hàng</label>
                                <div class="border">
                                    {{ $orders->address1 }},<br>
                                     {{ $orders->address2 }},<br>
                                     {{ $orders->city }}
                                </div>
                                <label for="">Zip code</label>
                                <div class="border">{{ $orders->pincode }}</div>
                            </div>
                            <div class="col-md-6">
                                <h4>Chi tiết hàng hóa</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên hàng</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Hình ảnh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderitems as $item)
                                        <tr>
                                           <td>{{$item->products->name}}</td>
                                           <td>{{$item->qty}}</td>
                                           <td>{{$item->price}}</td>
                                           <td>
                                            <img width="50px" src="{{asset('assets/uploads/products/'.$item->products->image)}}" alt="">

                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2">Tổng tiền: <span class="float-end">{{$orders->total_price}}</span></h4>
                                <h6 class="px-2">Phương thức thanh toán: {{$orders->payment_mode}}</h6>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
