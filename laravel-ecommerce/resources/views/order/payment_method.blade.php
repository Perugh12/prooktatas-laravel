<div class="payment-method-wrapper">
    <form id="payment-method-form">
        <div class="row">
            <div class="col-12">
                Fizetési mód
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="transfer">
                        <label class="form-check-label">
                            Átutalás
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="cash">
                        <label class="form-check-label">
                            Készpénz
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button id="send-payment-method-btn" type="button" class="btn btn-primary float-end">Tovább</button>
            </div>
        </div>

    </form>
</div>

@push('scripts')
<script>
    function togglePanelsForPaymentMethodEnd() {
        const panelPaymentMethod = document.getElementById('panel-payment-method');
        const panelPaymentCollapse = new bootstrap.Collapse(panelPaymentMethod, {
            toggle: true
        });

        const panelSummary = document.getElementById('panel-summary');
        const panelSummaryCollapse = new bootstrap.Collapse(panelSummary, {
            toggle: true
        });
    }

    function sendPaymentMethod() {
        const formData = new FormData(document.getElementById('payment-method-form'));
        window.axios.post("{{route('order.payment.method.store')}}", formData)
            .then(function(response) {
                if (response.data.success) {
                    togglePanelsForPaymentMethodEnd();
                    renderSummary();
                }
            })
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('send-payment-method-btn').addEventListener('click', function() {
            sendPaymentMethod();
        });
    });
</script>
@endpush