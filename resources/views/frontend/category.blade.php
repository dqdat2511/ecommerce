@extends('layouts.front')

@section('title')
    Danh mục
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">Tất cả danh mục</h6>
    </div>
</div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Tất cả danh mục</h2>
                    <div class="row">
                        @foreach ($category as $cate)
                        <div class="col-md-3 mb-3">
                            <a href="{{ url('category/'.$cate->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/category/'. $cate->image) }}" alt="Product_Image">
                                    <div class="card-body">
                                        <h5>{{ $cate->name }}</h5>
                                        <p>
                                            {{$cate->description}}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
