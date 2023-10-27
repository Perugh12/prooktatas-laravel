<div class="shipping-address-wrapper">
    <form id="shipping-address-form">
        <div class="row">
            <div class="col-12">
                <h5>Számlázási cím megadása</h5>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Vezetéknév</label>
                            <input type="text" class="form-control" name="firstname" value="{{ $test['shipping_address']['firstname'] }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefonszám</label>
                            <input type="text" class="form-control" name="phone" value="{{ $test['shipping_address']['phone'] }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cégnév</label>
                            <input type="text" class="form-control" name="company" value="{{ $test['shipping_address']['company'] }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Keresztnév</label>
                            <input type="text" class="form-control" name="lastname" value="{{ $test['shipping_address']['lastname'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $test['shipping_address']['email'] }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Ország</label>
                            <input type="text" class="form-control" name="country" value="{{ $test['shipping_address']['country'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Irányítószám</label>
                            <input type="text" class="form-control" name="zipcode" value="{{ $test['shipping_address']['zipcode'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Közterület neve</label>
                            <input type="text" class="form-control" name="street_name" value="{{ $test['shipping_address']['street_name'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Házszám</label>
                            <input type="number" class="form-control" name="house_number" value="{{ $test['shipping_address']['house_number'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Emelet</label>
                            <input type="text" class="form-control" name="floor_number" value="{{ $test['shipping_address']['floor_number'] }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Megye</label>
                            <input type="text" class="form-control" name="state" value="{{ $test['shipping_address']['state'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Város</label>
                            <input type="text" class="form-control" name="city" value="{{ $test['shipping_address']['city'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Közterület Jellege</label>
                            <input type="text" class="form-control" name="street_type" value="{{ $test['shipping_address']['street_type'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Épület</label>
                            <input type="text" class="form-control" name="building_number" value="{{ $test['shipping_address']['building_number'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ajtó</label>
                            <input type="text" class="form-control" name="apartment_number" value="{{ $test['shipping_address']['apartment_number'] }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <button id="send-shipping-address-btn" type="button" class="btn btn-primary float-end">Tovább</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function togglePanelsForShippingEnd() {
        const panelShippingAddress = document.getElementById('panel-shipping-address');
        const panelShippingAddressCollapse = new bootstrap.Collapse(panelShippingAddress, {
            toggle: true
        });

        const panelShipmentMethod = document.getElementById('panel-shipment-method');
        const panelShipmentCollapse = new bootstrap.Collapse(panelShipmentMethod, {
            toggle: true
        });
    }

    function sendShippingAddress() {
        const formData = new FormData(document.getElementById('shipping-address-form'));
        window.axios.post("{{route('order.shipping.address.store')}}", formData)
            .then(function(response) {
                if (response.data.success) {
                    togglePanelsForShippingEnd();
                }
            })
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('send-shipping-address-btn').addEventListener('click', function() {
            sendShippingAddress();
        });
    });
</script>
@endpush