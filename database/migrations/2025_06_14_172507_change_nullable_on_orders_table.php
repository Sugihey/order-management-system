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
            $table->string('room_no')->nullable()->change();
            $table->string('resident_name')->nullable()->change();
            $table->string('resident_phone_no')->nullable()->change();
            $table->date('assign_deadline')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('room_no')->change();
            $table->string('resident_name')->change();
            $table->string('resident_phone_no')->change();
            $table->date('assign_deadline')->change();
        });
    }
};
