<div class="shipment-method-wrapper">
    <form id="shipment-method-form">
        <div class="row">
            <div class="col-12">
                Szállítási mód
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="shipment_method" value="delivery">
                        <label class="form-check-label">
                            Házhoz szállítás
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="shipment_method" value="pickup">
                        <label class="form-check-label">
                            Boltban átveszem
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button id="send-shipment-method-btn" type="button" class="btn btn-primary float-end">Tovább</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function togglePanelsForShipmentMethodEnd() {
        const panelShipmentMethod = document.getElementById('panel-shipment-method');
        const panelShipmentCollapse = new bootstrap.Collapse(panelShipmentMethod, {
            toggle: true
        });

        const panelPaymentMethod = document.getElementById('panel-payment-method');
        const panelPaymentMethodCollapse = new bootstrap.Collapse(panelPaymentMethod, {
            toggle: true
        });
    }

    function sendShipmentMethod() {
        const formData = new FormData(document.getElementById('shipment-method-form'));
        window.axios.post("{{route('order.shipment.method.store')}}", formData)
            .then(function(response) {
                if (response.data.success) {
                    togglePanelsForShipmentMethodEnd();
                }
            })
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('send-shipment-method-btn').addEventListener('click', function() {
            sendShipmentMethod();
        });
    });
</script>
@endpush