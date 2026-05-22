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
    Schema::create('payments', function (Blueprint $table) {
        $table->id('payment_id');
        $table->unsignedBigInteger('subscription_id');
        $table->decimal('amount', 10, 2)->nullable();
        $table->string('payment_method')->nullable();
        $table->timestamp('payment_date')->nullable();
        $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');

        $table->foreign('subscription_id')->references('subscription_id')->on('subscriptions')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('payments');
}
};
