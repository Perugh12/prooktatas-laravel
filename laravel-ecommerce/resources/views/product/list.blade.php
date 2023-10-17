@extends('layout.app')

@section('content')

<div class="row">
    <div class="col-3">
        <div class="sidebar-wrapper">
            <ul class="list-group">
                @foreach($product_categories as $product_category)
                <li class="list-group-item">
                    <a href="{{ route('product.list', ['category' => $product_category['slug']]) }}"> {{ $product_category['name'] }} ({{$product_category['product_count']}})</a>
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
                            <div id="product-wrapper-{{$product->id}}" class="single-product product-image-bg">
                                <div class="part-1">
                                    <ul>
                                        <li>
                                            <a href="javascript:;" class="add-product-to-cart" data-product_id="{{$product->id}}">
                                                <i class="fas fa-shopping-cart" data-product_id="{{$product->id}}"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="add-product-to-wishlist" data-product_id="{{$product->id}}">
                                                <i class="fas fa-heart" data-product_id="{{$product->id}}"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="part-2">
                                    <h3 class="product-title">{{$product->name}}</h3>
                                    <h4 class="product-price">{{$product->unit_price}} Ft</h4>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addToCartButtons = document.querySelectorAll('.add-product-to-cart');
        const addToWishlistButtons = document.querySelectorAll('.add-product-to-wishlist');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();

                const productId = event.target.dataset.product_id;
                const quantity = 1;

                window.axios.post('{{route('cart.add')}}', {
                    product_id: productId,
                    quantity: quantity
                }).then(response => {
                    console.log(response.data);
                }).catch(error => {
                    console.log(error);
                });                
            });
        });

        addToWishlistButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();

                const productId = event.target.dataset.product_id;
                const quantity = 1;

                window.axios.post('{{route('wishlist.add')}}', {
                    product_id: productId,
                    quantity: quantity
                }).then(response => {
                    console.log(response.data);
                }).catch(error => {
                    console.log(error);
                });             
            });
        });

        /*window.axios.post('{{route('cart.add')}}', {
            product_id: 1,
            quantity: 1
        }).then(response => {
            console.log(response.data);
        }).catch(error => {
            console.log(error);
        });*/
    });
</script>
@endpush

@push('style')
<style>
    @foreach($products as $product) 
    .section-products #product-wrapper-{{$product->id}} .part-1::before {
        background: url('{{Vite::asset("resources/images/$product->image")}}') no-repeat;
    }
    @endforeach    
</style>
@endpush