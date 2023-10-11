@extends('layout.app')

@section('content')

<div class="row">
    <div class="col-3">
        <div class="sidebar-wrapper">
            <ul class="list-group">
                @foreach($product_categories as $product_category)
                <li class="list-group-item">
                    <a href="{{ route('products.list', ['category' => $product_category['slug']]) }}"> {{ $product_category['name'] }} ({{$product_category['product_count']}})</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-9">
        <div class="content-wrapper">
            <section class="section-products">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-8 col-lg-6">
                            <div class="header">
                                <h2>{{ $active_category_name }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-6 col-lg-5 col-xl-4">
                            <div id="product-1" class="single-product">
                                <div class="part-1">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                        <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="part-2">
                                    <h3 class="product-title">{{$product->name}}</h3>
                                    <h4 class="product-old-price">$79.99</h4>
                                    <h4 class="product-price">$49.99</h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection