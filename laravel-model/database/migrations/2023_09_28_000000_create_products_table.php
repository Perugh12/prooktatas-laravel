<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->float('price');
            $table->text('description')->nullable();          
            $table->timestamps();
        });
    }

    function down(): void
    {
        Schema::dropIfExists('products');
    }
};
