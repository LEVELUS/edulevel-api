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
    Schema::create('questions', function (Blueprint $table) {
        $table->id('question_id');
        $table->unsignedBigInteger('subject_id');
        $table->unsignedBigInteger('grade_id');
        $table->text('content');
        $table->enum('question_type', ['mcq', 'single_choice', 'true_false', 'open'])->default('mcq');
        $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('medium');
        $table->integer('points')->default(1);

        $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
        $table->foreign('grade_id')->references('grade_id')->on('school_grades')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('questions');
}
};
