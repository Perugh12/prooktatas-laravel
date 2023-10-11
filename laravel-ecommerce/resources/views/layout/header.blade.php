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
                        <a class="nav-link @if($page == 'products') active @endif" href="#">Termékek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($page == 'contact') active @endif" href="#">Kapcsolat</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>