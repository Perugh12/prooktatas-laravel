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

    function addProductToCart(product_id, quantity){
        window.axios.post('{{route('cart.add')}}', {
            product_id: product_id,
            quantity: quantity
        }).then((response) => {
           if (
            (typeof response.data.status !== 'undefined' && response.data.status) && (typeof response.data.message !== 'undefined' && response.data.message)
            ) {
                window.swal.fire({
                    position: 'top-end',
                    icon: response.data.status,
                    title: response.data.message,
                    showConfirmButton: false,
                    toast: true,
                    timer: 1500
                });                
            } else {
                window.swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Hiba történt!',
                    showConfirmButton: false,
                    toast: true,
                    timer: 1500,
                    showCloseButton: true
                });
                
            }

            window.refreshCartCount();
        }).catch(error => {
            window.swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Hiba történt!',
                showConfirmButton: false,
                toast: true,
                timer: 1500,
                showCloseButton: true
            });
        })
    }

    document.addEventListener('DOMContentLoaded', () => {
        const addToCartButtons = document.querySelectorAll('.add-product-to-cart');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();

                addProductToCart(event.target.dataset.product_id, 1);
            });
        });        
    });
</script>
@endpush

@push('style')
<style>
    @foreach($products as $product) 
    .section-products #product-wrapper-{{$product->id}} .part-1::before {
        background: url('@if(str_contains($product->image, "http")) $product->image @else {{Vite::asset("resources/images/$product->image")}} @endif') no-repeat;
    }
    @endforeach    
</style>
@endpush