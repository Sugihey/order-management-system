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
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('quantity')->default(0)->change();
            $table->string('incoming_order_price')->default(0)->change();
            $table->string('purchase_order_price')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('quantity')->change();
            $table->string('incoming_order_price')->change();
            $table->string('purchase_order_price')->change();
        });
    }
};
