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
        Schema::table('customers', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable()->change();
        });

        Schema::table('artisans', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable()->change();
        });

        Schema::table('billing_destinations', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable()->change();
        });

        Schema::table('operations', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable()->change();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->change();
        });

        Schema::table('artisans', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->change();
        });

        Schema::table('billing_destinations', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->change();
        });

        Schema::table('operations', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->change();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->change();
        });
    }
};
