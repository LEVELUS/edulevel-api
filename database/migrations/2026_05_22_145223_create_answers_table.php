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
    Schema::create('answers', function (Blueprint $table) {
        $table->id('answer_id');
        $table->unsignedBigInteger('question_id');
        $table->text('content');
        $table->boolean('is_correct')->default(false);

        $table->foreign('question_id')->references('question_id')->on('questions')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('answers');
}
};
