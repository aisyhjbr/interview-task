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
        Schema::create('product_topping', function (Blueprint $table) {
            $table->string('product_id');
            $table->string('topping_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('topping_id')->references('id')->on('toppings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_topping');
    }
};
