@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin người dùng
                        <a href="{{url('users')}}" class="btn btn-primary btn-sm float-end">Trở về</a>
                    </h4>
                   <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Vai trò</label>
                            <div class="p-2 border">{{$users->roll_as == '0'? 'Client':'Admin'}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Họ</label>
                            <div class="p-2 border">{{$users->lname}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Tên</label>
                            <div class="p-2 border">{{$users->name}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Email</label>
                            <div class="p-2 border">{{$users->email}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Số điện thoại</label>
                            <div class="p-2 border">{{$users->phone}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Địa chỉ</label>
                            <div class="p-2 border">
                                {{$users->address1}},
                                 {{$users->address2}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Thành phố</label>
                            <div class="p-2 border">{{$users->city}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Mã zip</label>
                            <div class="p-2 border">{{$users->pincode}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
