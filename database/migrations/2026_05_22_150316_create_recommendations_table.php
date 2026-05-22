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
    Schema::create('recommendations', function (Blueprint $table) {
        $table->id('recommendation_id');
        $table->unsignedBigInteger('user_id');
        $table->text('content');
        $table->timestamp('created_at')->useCurrent();

        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('recommendations');
}
};
