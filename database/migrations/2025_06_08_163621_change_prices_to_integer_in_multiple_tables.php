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
        Schema::table('multiple_tables', function (Blueprint $table) {
            Schema::table('unit_prices', function (Blueprint $table) {
                $table->integer('incoming_order_price')->change();
                $table->integer('purchase_order_price')->change();
            });
    
            Schema::table('order_details', function (Blueprint $table) {
                $table->integer('incoming_order_price')->change();
                $table->integer('purchase_order_price')->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('multiple_tables', function (Blueprint $table) {
            Schema::table('unit_prices', function (Blueprint $table) {
                $table->decimal('incoming_order_price', 10, 2)->change();
                $table->intedecimalger('purchase_order_price', 10, 2)->change();
            });
    
            Schema::table('order_details', function (Blueprint $table) {
                $table->decimal('incoming_order_price', 10, 2)->change();
                $table->decimal('purchase_order_price', 10, 2)->change();
            });
        });
    }
};
