<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel - Homework</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>

<body>
    <div class="container p-5 my-3 border">
        <div class="text-center">
            <h1>Házi feladat</h1>
            <h2>Bootstrap + Collection</h2>
        </div>

        <div class="mt-5">
            <h3>1. Adott egy kollekció, rendezd növekvő sorrendbe és add vissza.</h3>
            <span><?php echo e($first_task); ?></span>
        </div>
        <hr>
        <div class="mt-5">
            <h3>2. Adott egy kollekció, szűrd ki azokat az elemeket, amelyek párosak</h3>
            <span><?php echo e($second_task); ?></span>
        </div>
        <hr>
        <div class="mt-5">
            <h3>3. Adott egy kollekció, számold meg, hány elem van benne.</h3>
            <span><?php echo e($third_task); ?></span>
        </div>
        <hr>
        <div class="mt-5">
            <h3>4. Adott egy kollekció, hozz létre belőle egy új kollekciót, amelynek minden elemét megszorzod kettővel.</h3>
            <span><?php echo e($fourth_task); ?></span>
        </div>
        <hr>
        <div class="mt-5">
            <h3>5. Adott egy kollekció, vedd ki belőle az első elemet.</h3>
            <span><?php echo e($fifth_task); ?></span>
        </div>
        <hr>
        <div class="mt-5">
            <h3>6. Adott egy kollekció, ellenőrizd, hogy tartalmazza-e az "x" karaktert.</h3>
            <span><?php echo e($sixth_task); ?></span>
        </div>
        <hr>
        <div class="mt-5">
            <h3>7. Adott egy kollekció, add hozzá az elemeket egy másik kollekcióhoz.</h3>
            <span><?php echo e($seventh_task); ?></span>
        </div>
        <hr>
        <div class="mt-5">
            <h3>8. Adott egy kollekció, írd ki az elemeket egyenként a konzolra.</h3>
            <span><?php echo e($eighth_task); ?></span>
        </div>
        <hr>
        <div class="mt-5">
            <h3>9. Adott egy kollekció, vedd ki belőle az utolsó elemet.</h3>
            <span><?php echo e($ninth_task); ?></span>
        </div>
        <hr>
        <div class="mt-5">
            <h3>10. Adott egy kollekció, számold meg, hány elem felel meg egy adott feltételnek.</h3>
            <span><?php echo e($tenth_task); ?></span>
        </div>
        <hr>

    </div>

</body>

</html><?php /**PATH C:\laravel-xampp\prooktatas-laravel\lesson-6-7-homework\resources\views/index.blade.php ENDPATH**/ ?>