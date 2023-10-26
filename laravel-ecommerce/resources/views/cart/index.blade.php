@extends('layout.app')

@section('content')
<div class="row"> 
    <div class="col-12">
        <div class="content-wapper">
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
                        @foreach($cart_products as $index => $cart_product)
                        <div id="cart-product-row-{{$index}}" class="row">
                            <div class="col-12">
                                <div class="cart-product-wrapper">
                                    <div class="row mb-2">
                                        <div class="col-12 col-lg-3 mb-2">
                                            <div class="cart-product-image">
                                                <img src="
                                                @if(str_contains($cart_product->product->image, 'http')) 
                                                    {{ $cart_product->product->image }} 
                                                @else 
                                                    {{Vite::asset('resources/images/'. $cart_product->product->image)}} 
                                                @endif
                                                " alt="" class="w-100">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center align-items-lg-start mb-2 mb-lg-0">
                                            <div class="cart-product-details">
                                                <h3 class="cart-product-name">{{ $cart_product->product->name }}</h3>
                                                <div class="cart-product-price">{{ $cart_product->unit_price }} Ft</div>
                                                <div class="cart-product-quantity">Mennyiség: {{ $cart_product->quantity }} db</div>
                                                <div class="cart-product-total-price">Összesen: {{ $cart_product->total_price }} Ft</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-2 d-flex flex-row justify-content-center align-items-center mb-2 mb-lg-0">
                                            <div class="cart-product-actions">
                                                <div class="input-group mb-3 mb-lg-0">
                                                    <button class="btn btn-outline-secondary change-quantity-btn" type="button" data-cart-product-id="{{ $cart_product->id }}" data-change="decrease" data-index="{{$index}}">-</button>
                                                    <input type="text" class="form-control text-center change-quantity-input" value="{{ $cart_product->quantity }}" min="1" step="1" data-cart-product-id="{{ $cart_product->id }}" data-index="{{$index}}">
                                                    <button class="btn btn-outline-secondary change-quantity-btn" type="button" data-cart-product-id="{{ $cart_product->id }}" data-change="increase" data-index="{{$index}}">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-1 d-flex flex-row justify-content-center align-items-center mb-2 mb-lg-0">
                                            <div class="cart-product-actions">
                                                <a href="javascript:;" class="btn btn-secondary remove-product-from-cart" data-cart-product-id="{{ $cart_product->id }}" data-index="{{$index}}">
                                                    <i class="fas fa-trash-alt" data-cart-product-id="{{ $cart_product->id }}" data-index="{{$index}}"></i>
                                                </a>
                                            </div>
                                        </div>                    
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        @endforeach
                        @else
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    A kosár üres
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
        const changeQuantityBtns = document.querySelectorAll('.change-quantity-btn');
        const removeProductFromCartBtns = document.querySelectorAll('.remove-product-from-cart');
        const changeQuantityInputs = document.querySelectorAll('.change-quantity-input');

        function changeQuantity(cartProductId, change, quantity, index){
            axios.patch("{{route('cart.change-quantity')}}", {
                cart_product_id: cartProductId,
                change: change,
                quantity: quantity
            })
            .then(function (response) {
                window.swal.fire({
                    title: response.data.message,
                    icon: response.data.status,
                    position: 'top-end',
                    showConfirmButton: false,
                    toast: true,
                    timer: 2500,
                    showCloseButton: true,
                })

                if(response.data.status == 'success'){
                    changeQuantityInputs[index].value = response.data.new_quantity
                }
            })
        }

        function deleteProductFromCart(cartProductId, index){
            axios.delete(`{{route('cart.remove', '')}}/${cartProductId}`)
            .then(function (response) {
                window.swal.fire({
                    title: "A termék sikeresen törölve lett a kosárból",
                    icon: "success",
                    position: 'top-end',
                    showConfirmButton: false,
                    toast: true,
                    timer: 2500,
                    showCloseButton: true,
                })

                document.getElementById(`cart-product-row-${index}`).remove()
            })
        }

        changeQuantityBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const cartProductId = parseInt(e.target.dataset.cartProductId)
                const change = e.target.dataset.change
                const quantity = 1
                const index = parseInt(e.target.dataset.index)

                changeQuantity(cartProductId, change, quantity, index)
            })
        })

        removeProductFromCartBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const cartProductId = parseInt(e.target.dataset.cartProductId)
                const index = parseInt(e.target.dataset.index)

                deleteProductFromCart(cartProductId, index)
            })
        })

        changeQuantityInputs.forEach(input => {
            input.addEventListener('keyup', (e) => {
                const cartProductId = parseInt(e.target.dataset.cartProductId)
                const change = 'change'
                const quantity = parseInt(e.target.value)
                const index = parseInt(e.target.dataset.index)

                changeQuantity(cartProductId, change, quantity, index)
            })
        })
    </script>
@endpush

@push('style')
    <style>
    </style>
@endpush