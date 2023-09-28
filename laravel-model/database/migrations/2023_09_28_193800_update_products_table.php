<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->mediumText('image')->nullable()->after('description');
            $table->foreignId('category_id')->nullable()->after('id');
            $table->integer('stock')->default(0)->after('price');
        });
    }

    function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['image', 'category_id', 'stock']);
        });
    }
};
