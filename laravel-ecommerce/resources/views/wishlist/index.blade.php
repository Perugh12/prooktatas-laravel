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
                                <h2>Kedvencek</h2>
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
            <a href="" class="btn btn-primary">Kosárba</a>
            <a href="" class="btn btn-danger">Töröl</a>
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