@extends('layouts.front')

@section('title', "Chỉnh sửa bình luận sản phẩm")


@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <h5>Viết bình luân cho {{$review->product->name}}</h5>
                            <form action="{{url('/update-review')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="review_id" value="{{$review->id}}">
                                <textarea class="form-control" name="user_review" placeholder="Viết bình luận về sản phẩm" id="" cols="30" rows="10">{{$review->user_review}}</textarea>
                                <button type="submit" class="btn btn-primary mt-3">Đăng bình luận</button>
                            </form>
                        {{-- @else
                            <div class="alert alert-danger">
                                <h5>
                                    Bạn chưa thể bình luận sản phẩm này
                                </h5>
                                <p>
                                    Để có được bình luận đáng tin cậy nhất, chỉ những khách hàng đã trải nghiệm
                                        có thể bình luận về sản phẩm
                                </p>
                                <a href="{{url('/')}}" class="btn btn-primary mt-3">Trở về trang chủ</a>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
