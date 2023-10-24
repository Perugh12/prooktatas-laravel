<header class="mb-2 border">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Laravel E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if($page == 'products') active @endif" href="{{ route('product.list', 'osszes-termek') }}">Termékek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($page == 'contact') active @endif" href="{{ route('contact') }}">Kapcsolat</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item me-2">
                        <a class="nav-link position-relative" href="{{ route('wishlist') }}">
                            <i class="fas fa-heart"></i>
                            <span class="wishlist-count-wrapper position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count-wrapper position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger"></span>
                        </a>                       
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        window.refreshCartCount();

        /*window.axios.get('{{route('wishlist.count')}}',)
        .then(response => {
            document.querySelector('.wishlist-count').innerHTML = response.data.count;
        }).catch(error => {
            console.log(error);
        });*/
    });
</script>
@endpush