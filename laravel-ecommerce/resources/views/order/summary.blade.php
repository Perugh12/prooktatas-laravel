<div class="summary-wrapper">
    <div class="row">
        <div class="col-12">
            <h5>Összegzés</h5>
        </div>

        <div class="col-12">
            <div class="row">
                <table id="summary-table" class="table">
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12">
            <button id="send-order-btn" type="button" class="btn btn-primary float-end">Küldés</button>
        </div>
    </div>

</div>


@push('scripts')
<script>
    function renderSummary() {
        window.axios.get("{{route('order.summary')}}")
            .then(function(response) {
                if (response.data.order) {
                    var html = '';
                    var billingAddress = Object.values(response.data.order.billing_address).join(' ');
                    var shippingAddress = Object.values(response.data.order.shipping_address).join(' ');
                    var paymentMethod = Object.values(response.data.order.payment_method).join(' ');
                    var shipmentMethod = Object.values(response.data.order.shipment_method).join(' ');

                    html += '<tr>';
                    html += '<td>Számlázási adatok</td>';
                    html += `<td>${billingAddress}</td>`;
                    html += '</tr>';
                    html += '<tr>';
                    html += '<td>Szállítási adatok</td>';
                    html += `<td>${shippingAddress}</td>`;
                    html += '</tr>';
                    html += '<tr>';
                    html += '<td>Szállítási mód</td>';
                    html += `<td>${shipmentMethod}</td>`;
                    html += '</tr>';
                    html += '<tr>';
                    html += '<td>Fizetési mód</td>';
                    html += `<td>${paymentMethod}</td>`;
                    html += '</tr>';

                    const tableBody = document.getElementById('summary-table').getElementsByTagName('tbody')[0];
                    tableBody.innerHTML = html;
                }
            })
    }

    function sendOrder() {
        window.axios.post("{{route('order.store')}}")
            .then(function(response) {
                if (response.data.success) {
                    window.location.href = "{{route('order.end')}}";
                }
            })
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('send-order-btn').addEventListener('click', function() {
            sendOrder();
        });
    });
</script>
@endpush