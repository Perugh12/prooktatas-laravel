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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('company')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('zipcode');
            $table->string('city');
            $table->string('street_name'); // király
            $table->string('street_type'); // utca
            $table->string('house_number'); // 1
            $table->string('building_number')->nullable(); // A
            $table->string('floor_number')->nullable(); // 1
            $table->string('apartment_number')->nullable(); // 1
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
