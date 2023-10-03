<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('status')->default('pedding');
            $table->string('payment_method');
            $table->string('shipping_method');

            $table->string('payment_firstname');
            $table->string('payment_lastname');
            $table->string('payment_phone');
            $table->string('payment_email');
            $table->string('payment_company')->nullable();
            $table->string('payment_country');
            $table->string('payment_state');
            $table->string('payment_zipcode');
            $table->string('payment_city');
            $table->string('payment_street_name'); // király
            $table->string('payment_street_type'); // utca
            $table->string('payment_house_number'); // 1
            $table->string('payment_building_number')->nullable(); // A
            $table->string('payment_floor_number')->nullable(); // 1
            $table->string('payment_apartment_number')->nullable(); // 1

            $table->string('shipping_firstname')->nullable();
            $table->string('shipping_lastname')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_company')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_zipcode')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_street_name')->nullable(); // király
            $table->string('shipping_street_type')->nullable(); // utca
            $table->string('shipping_house_number')->nullable(); // 1
            $table->string('shipping_building_number')->nullable(); // A
            $table->string('shipping_floor_number')->nullable(); // 1
            $table->string('shipping_apartment_number')->nullable(); // 1                

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
