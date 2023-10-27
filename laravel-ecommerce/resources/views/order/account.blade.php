<div class="account-wrapper">
    <div class="row">
        <div class="col-12 col-lg-6 text-center">
            <h5>Regisztráció nélküli vásárlás</h5>
            <button id="order-without-account" class="btn btn-primary">Tovább</button>
        </div>

        <div class="col-12 col-lg-6 text-center">
            <h5>Bejelentkezés</h5>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePanelsForAccountEnd() {
        const panelAccount = document.getElementById('panel-account');
        const panelAccountCollapse = new bootstrap.Collapse(panelAccount, {
            toggle: true
        });

        const panelBillingAddress = document.getElementById('panel-billing-address');
        const panelBillingAddressCollapse = new bootstrap.Collapse(panelBillingAddress, {
            toggle: true
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('order-without-account').addEventListener('click', function() {
            togglePanelsForAccountEnd();
        });
    });
</script>
@endpush