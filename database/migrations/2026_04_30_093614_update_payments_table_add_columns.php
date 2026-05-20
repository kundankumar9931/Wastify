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
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'subscription_id')) {
                $table->foreignId('subscription_id')->nullable()->constrained()->onDelete('set null');
            }
            if (!Schema::hasColumn('payments', 'paymentDate')) {
                $table->dateTime('paymentDate')->nullable();
            }
            if (!Schema::hasColumn('payments', 'method')) {
                $table->string('method')->default('Razorpay');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['subscription_id']);
            $table->dropColumn(['subscription_id', 'paymentDate', 'method']);
        });
    }
};
