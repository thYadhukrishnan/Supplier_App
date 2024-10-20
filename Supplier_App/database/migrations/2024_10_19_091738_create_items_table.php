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
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_no');
            $table->string('item_name');
            $table->string('inventory_location');
            $table->string('brand');
            $table->string('category');
            $table->integer('supplier_id');
            $table->integer('stock_unit');
            $table->integer('unit_price');
            $table->string('item_images');
            $table->string('status')->default('Enabled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
