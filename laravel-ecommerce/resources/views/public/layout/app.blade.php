<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | {{ config('app.name') }}</title>
</head>

<body>
    @include('public.layout.header')
    @yield('content')
    @include('public.layout.footer')
</body>

</html>