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
            <a href="{{ route('checkout') }}" class="btn btn-primary">Fizetés</a>
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