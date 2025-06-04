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
            $table->foreignId('billing_destination_id')->constrained('billing_destinations');
            $table->string('order_type', 45);
            $table->string('billing_destination_name');
            $table->string('property_name');
            $table->string('property_address');
            $table->string('room_no');
            $table->date('order_date');
            $table->date('deadline');
            $table->boolean('is_photo_required');
            $table->boolean('is_call_required');
            $table->string('resident_name');
            $table->string('resident_phone_no');
            $table->date('assign_deadline');
            $table->string('jurisdiction', 45);
            $table->string('order_no', 45)->unique();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            
            $table->index('billing_destination_name');
            $table->index('property_name');
            $table->index('deadline');
            $table->index('assign_deadline');
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
