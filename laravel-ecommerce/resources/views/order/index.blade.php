<!DOCTYPE html>
<html lang="hu" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/app.css')}}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
</head>

<body class="h-100">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 h-100">
                @include('layout.header')              
               
               <form action="" method="post">
                    @csrf

                    @include('order.account')
                    @include('order.billing_address')
                    @include('order.shipment_address')
                    @include('order.shipment_method')
                    @include('order.payment_method')
                    @include('order.summary')
                </form>
                 @include('layout.footer')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @stack('scripts')
    <script>
        window.refreshCartCount = function(){
             window.axios.get('{{route('cart.count')}}').then(response => {
                if (typeof response.data.count !== 'undefined' && response.data.count) {
                    document.querySelector('.cart-count-wrapper').innerHTML = response.data.count;    
                }else {
                    document.querySelector('.cart-count-wrapper').innerHTML = 0;
                }
                
            })
        }
    </script>
</body>

</html>