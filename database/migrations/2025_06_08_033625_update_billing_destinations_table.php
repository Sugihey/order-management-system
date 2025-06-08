<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('billing_destinations', function (Blueprint $table) {
            $table->dropColumn(['due_date', 'billing_month', 'billing_day']);
            $table->tinyInteger('due_day')->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('billing_destinations', function (Blueprint $table) {
            $table->dropColumn('due_day');
            $table->date('due_date')->after('name');
            $table->tinyInteger('billing_month')->after('due_date');
            $table->tinyInteger('billing_day')->after('billing_month');
        });
    }
};
