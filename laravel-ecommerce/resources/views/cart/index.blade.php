@extends('layout.app')

@section('content')

<div class="row">    
    <div class="col-12">
        <div class="content-wrapper">
            <section class="section-products">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-8 col-lg-6">
                            <div class="header">
                                <h2>Kosár</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">        
                        <hr>
                        @if($cart_products->count())
                        @foreach($cart_products as $cart_product)
                            <div class="row">
                                <div class="col-12">
                                   <div class="cart-product-wapper">
                                    <div class="row mb-2">
                                        <div class="col-12 col-lg-3 mb-2">
                                            <div class="cart-product-image">
                                                <img src="
                                                @if(str_contains($cart_product->product->image, 'http')) 
                                                    {{$cart_product->product->image}} 
                                                @else 
                                                    {{Vite::asset('resources/images/{$cart_product->product->image}')}}
                                                 @endif" alt="{{ $cart_product->product->name }}" class="w-100">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center align-items-lg-start mb-2 mb-lg-0">
                                            <div class="cart-product-details">
                                                <h3 class="cart-product-name">{{ $cart_product->product->name }}</h3>
                                                <div class="cart-product-price">{{ $cart_product->unit_price }} Ft</div>
                                                <div class="cart-product-quantity">Mennyiség: {{ $cart_product->quantity }} db</div>
                                            <div class="cart-product-total-price">Összesen: {{ $cart_product->total_price }} Ft</div>
                                        </div>                                       
                                        <div class="col-12 col-lg-2 d-flex flex-row justify-content-center align-items-center mb-2 mb-lg-0">
                                            <div class="cart-product-actions">
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-outline-secondary change-quantity-btn" type="button" data-product-id="{{ $cart_product->product_id }}" data-change="decrease">-</button>
                                                    <input type="text" class="form-control text-center" value="{{ $cart_product->quantity }}" readonly>
                                                    <button class="btn btn-outline-secondary change-quantity-btn" type="button" data-product-id="{{ $cart_product->product_id }}" data-change="increase">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-1 d-flex flex-row justify-content-center align-items-center mb-2 mb-lg-0">
                                            <div class="cart-product-actions">
                                                <a href="javascript:;" class="remove-product-from-cart" data-product-id="{{ $cart_product->product_id }}">
                                                    <i class="fas fa-trash-alt" data-product-id="{{ $cart_product->product_id }}"></i>
                                                </a>
                                            </div>
                                        </div>                                   
                                    </div>
                                   </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        @else
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    A kosár üres.
                                </div>
                            </div>
                        </div>                        
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="checkout-btn-wrapper text-end">
            <a href="{{ route('product.list', 'osszes-termek') }}" class="btn btn-secondary">Vásárlás folytatása</a>
            @if($cart_products->count())
                <a href="{{ route('checkout') }}" class="btn btn-primary">Fizetés</a>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush

@push('style')
<style>    
</style>
@endpush