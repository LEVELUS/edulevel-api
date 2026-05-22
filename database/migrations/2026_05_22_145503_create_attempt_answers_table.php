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
    Schema::create('attempt_answers', function (Blueprint $table) {
        $table->id('attempt_answer_id');
        $table->unsignedBigInteger('attempt_id');
        $table->unsignedBigInteger('question_id');
        $table->unsignedBigInteger('answer_id');
        $table->text('open_answer')->nullable();
        $table->boolean('is_correct')->nullable();
        $table->integer('time_spent')->nullable();

        $table->foreign('attempt_id')->references('attempt_id')->on('quiz_attempts')->onDelete('cascade');
        $table->foreign('question_id')->references('question_id')->on('questions')->onDelete('cascade');
        $table->foreign('answer_id')->references('answer_id')->on('answers')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('attempt_answers');
}
};
