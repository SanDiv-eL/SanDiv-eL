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
        Schema::table('orders', function (Blueprint $table) {
            // Change total_price to support larger Rupiah values
            // BIGINT UNSIGNED can store up to 18,446,744,073,709,551,615
            // Which is more than enough for Rupiah prices
            $table->unsignedBigInteger('total_price')->change();
        });
        
        Schema::table('order_items', function (Blueprint $table) {
            // Also update order_items price column
            $table->unsignedBigInteger('price')->change();
        });
        
        Schema::table('products', function (Blueprint $table) {
            // Also update products price column
            $table->unsignedBigInteger('price')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2)->change();
        });
        
        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change();
        });
        
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change();
        });
    }
};
