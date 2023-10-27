<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>

    <style type="text/css">
        i {
            font-size: 50px;
        }
    </style>
</head>

<body>
    <div id="app">

        <main class="container p-5">
            <h3>Hello <?php echo e($name); ?></h3>
        </main>
    </div>
</body>

</html><?php /**PATH C:\laravel-xampp\prooktatas-laravel\lesson-9-homework\resources\views/method/index.blade.php ENDPATH**/ ?>