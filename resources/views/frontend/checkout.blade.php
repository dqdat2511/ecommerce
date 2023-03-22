@extends('layouts.front')

@section('title')
    Welcome to E-shop
@endsection

@section('content')
    <div class="container mt-3">
        <form action="{{url('place-order')}}" method="POST">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Thông tin cơ bản</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="firstname">Họ</label>
                                <input type="text" class="form-control firstname" value="{{Auth::user()->lname}}" name="fname" placeholder="Họ">
                                <span id="fname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tên</label>
                                <input type="text" class="form-control lastname"  value="{{Auth::user()->name}}"name="lname" placeholder="Tên">
                                <span id="lname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Email</label>
                                <input type="email" class="form-control email"  value="{{Auth::user()->email}}"name="email" placeholder="a@email.com">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Số điện thoại</label>
                                <input type="number" class="form-control phone"  value="{{Auth::user()->phone}}"name="phone" placeholder="Số điện thoại">
                                <span id="phone_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Địa chỉ 1</label>
                                <input type="text" class="form-control address1" value="{{Auth::user()->address1}}" name="address1" placeholder="Địa chỉ 1">
                                <span id="address1_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Địa chỉ 2</label>
                                <input type="text" class="form-control address2" value="{{Auth::user()->address2}}" name="address2" placeholder="Địa chỉ 2">
                                <span id="address2_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Thành phố</label>
                                <input type="text" class="form-control city"  value="{{Auth::user()->city}}"name="city" placeholder="Thành phố ">
                                <span id="city_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Mã code</label>
                                <input type="text" class="form-control pincode"  value="{{Auth::user()->pincode}}"name="pincode" placeholder="Mã zip code ">
                                <span id="pincode_error" class="text-danger"></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Thông tin sản phẩm</h6>
                        <hr>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartitems as $item)
                                <tr>
                                    <td>{{$item->products->name}}</td>
                                    <td>{{$item->prod_qty}}</td>
                                    <td>{{$item->products->selling_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h6 class="px-2">Tổng tiền <span class="float-end">{{$total*1000}}</span></h6>
                        <hr>
                        <input type="hidden" name="payment_mode" value="COD">
                        <button type="submit" class="btn btn-success w-100">Đặt hàng</button>
                        <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Thanh Toán</button>
                        <div class="mt-3" id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

@endsection
@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=ASNsg69x6HKzXbMkwdNAzhrU9RpnF7OgLBlC32RR6k7MCmkxN5ulzEPoUguoATxvw0Ov28VlgPTcDJkK&currency=USD"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        const paypalButtonsComponent = paypal.Buttons({

            style: {
              color: "gold",
              shape: "rect",
              layout: "vertical"
            },
            createOrder: (data, actions) => {
                const createOrderPayload = {
                    purchase_units: [
                        {
                            amount: {
                                value: "{{$convert}}"
                            }
                        }
                    ]
                };
                return actions.order.create(createOrderPayload);
            },

            onApprove: (data, actions) => {
                const captureOrderHandler = (details) => {
                    const payerName = details.payer.name.given_name;
                    console.log('Transaction completed');

                    var firstname = $('.firstname').val();
                    var lastname = $('.lastname').val();
                    var email = $('.email').val();
                    var phone = $('.phone').val();
                    var address1 = $('.address1').val();
                    var address2 = $('.address2').val();
                    var city = $('.city').val();
                    var pincode = $('.pincode').val();
                    $.ajax({
                            method:"POST",
                                url: "/place-order",
                                data: {
                                    'fname':firstname,
                                    'lname':lastname,
                                    'phone':phone,
                                    'email':email,
                                    'address1':address1,
                                    'address2':address2,
                                    'city':city,
                                    'pincode':pincode,
                                    'payment_mode':"Thanh toán qua Paypal",
                                    'payment_id':details.id
                                },
                                success: function (responseb) {
                                    swal(responseb.status).then((value) => {
                                    window.location.href = "/my-order";
                                  });

                                }
                            });
                };

                return actions.order.capture().then(captureOrderHandler);
            },

            onError: (err) => {
                console.error('An error prevented the buyer from checking out with PayPal');
            }
        });

        paypalButtonsComponent
            .render("#paypal-button-container")
            .catch((err) => {
                console.error('PayPal Buttons failed to render');
            });
      </script>
@endsection
