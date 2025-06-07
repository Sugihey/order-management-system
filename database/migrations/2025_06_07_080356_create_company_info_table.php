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
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            $table->string('name', 46);
            $table->string('zip', 12);
            $table->string('address', 256);
            $table->string('phone_no', 20);
            $table->string('fax_no', 20)->nullable();
            $table->string('invoice_no', 14)->nullable();
            $table->string('bank_name', 46);
            $table->string('bank_branch', 46);
            $table->string('account_type', 10);
            $table->string('account_name', 46);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_info');
    }
};
