@extends('layouts.front')

@section('title')
    Welcome to E-shop
@endsection

@section('content')
    @include('layouts.inc.slider')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2 class="title-context">Thịnh hành</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($feature_products as $prod)
                        <div class="item">
                            <a href="{{url('category/'.$prod->category->slug.'/'.$prod->slug)}}">
                            <div class="card">
                                <img src="{{ asset('assets/uploads/products/' . $prod->image) }}" alt="Product_Image">
                                <div class="card-body">
                                    <h5>{{ $prod->name }}</h5>
                                    <span class="float-start">{{ $prod->selling_price }}</span>
                                    <span class="float-end"> <s> {{ $prod->original_price }}</s></span>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2 class="title-context">Danh mục thịnh hành</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($trending_category as $cate)
                        <div class="item">
                            <a href="{{ url('category/'.$cate->slug) }}">
                            <div class="card">
                                <img src="{{ asset('assets/uploads/category/' . $cate->image) }}" alt="Product_Image">
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
@endsection

@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots:false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
@endsection
