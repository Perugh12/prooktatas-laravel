@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="accordion" id="order-accordion">

            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panel-account">
                        Fiók
                    </button>
                </h2>
                <div id="panel-account" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        @include('order.account')
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panel-billing-address">
                        Számlázási cím
                    </button>
                </h2>
                <div id="panel-billing-address" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        @include('order.billing_address')
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panel-shipping-address">
                        Szállítási cím
                    </button>
                </h2>
                <div id="panel-shipping-address" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        @include('order.shipping_address')
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panel-shipment-method">
                        Szállítási mód
                    </button>
                </h2>
                <div id="panel-shipment-method" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        @include('order.shipment_method')
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panel-payment-method">
                        Fizetési mód
                    </button>
                </h2>
                <div id="panel-payment-method" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        @include('order.payment_method')
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panel-summary">
                        Összegzés
                    </button>
                </h2>
                <div id="panel-summary" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        @include('order.summary')
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-12 col-lg-4">
        <h2 class="accordion-header text-center">Termékek</h2>
        @include('order.products')
    </div>

</div>

@endsection