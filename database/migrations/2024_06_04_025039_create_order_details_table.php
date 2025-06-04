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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->integer('index');
            $table->foreignId('operation_id')->constrained('operations');
            $table->foreignId('artisan_id')->nullable()->constrained('artisans');
            $table->decimal('quantity', 9, 2);
            $table->decimal('incoming_order_price', 10, 2);
            $table->decimal('purchase_order_price', 10, 2);
            $table->dateTime('completion_date')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
