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
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->renameColumn('plan_name', 'plan');
            $table->renameColumn('expires_at', 'end_date');
            $table->date('start_date')->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->renameColumn('plan', 'plan_name');
            $table->renameColumn('end_date', 'expires_at');
            $table->dropColumn('start_date');
        });
    }
};
