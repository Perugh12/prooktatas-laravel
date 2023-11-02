<div class="order-product-wrapper mt-3">
    @foreach ($order_products as $index => $order_product)
    <div class="row mb-3" id="order-product-row-{{ $index }}">
        <div class="col-4">
            <div class="cart-product-image">
                <img src="@if(str_contains($order_product['image'], 'http')) 
                                                    {{ $order_product['image'] }} 
                                                @else 
                                                    {{Vite::asset('resources/images/'. $order_product['image'])}} 
                                                @endif
                                                " alt="" class="w-100">
            </div>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <h5>{{ $order_product['name'] }}</h5>
                </div>
                <div class="col-12">
                    {{ $order_product['description']}}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    {{ $order_product['quantity'] }} db
                </div>
                <div class="col-6">
                    {{ $order_product['total_price'] }} Ft
                </div>
            </div>
        </div>
        <div class="col-12">
              <div class="col-12 justify-content-end text-end">
                <button type="button" class="btn btn-sm btn-danger btn-order-product-delete" data-product_id="{{ $order_product['id'] }}" data-index="{{ $index }}"><i class="fa-solid fa-trash fa-sm"></i> Töröl</button>
            </div>
        </div>
    </div>
   
    <hr class="my-4">
    @endforeach
</div>

@push('scripts')
<script>
    const deleteOrderProdBtn = document.querySelectorAll('.btn-order-product-delete');

    function deleteOrderProduct(productId, index) {
        axios.delete(`{{route('order.remove', '')}}/${productId}`)
            .then(function(response) {
                if (response.session === null) {

                }
                window.swal.fire({
                    title: "A termék sikeresen törölve lett a megrendelésből!",
                    icon: "success",
                    position: 'top-end',
                    showConfirmButton: false,
                    toast: true,
                    timer: 2500,
                    showCloseButton: true,
                })

                document.getElementById(`order-product-row-${index}`).remove()
            })
    }

    deleteOrderProdBtn.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const productId = parseInt(e.target.dataset.product_id)
            const index = parseInt(e.target.dataset.index)

            deleteOrderProduct(productId, index)
        })
    })
</script>
@endpush