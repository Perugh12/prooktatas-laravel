<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style type="text/css">
        i {
            font-size: 50px;
        }
    </style>
</head>

<body>
    <div id="app">

        <main class="container p-5">
            <h3>Hello {{$user_id ?? 'Nem létezik Session'}}</h3>

             @if (isset($isset_user_id))
            <div class="row w-25">
                <div class="alert alert-{{ $alert }}" role="alert">
                    {{$msg ?? ''}}
                </div>       
            </div>        
            @endif
        </main>       
    </div>
</body>

</html>