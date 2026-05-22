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
    Schema::create('quiz_attempts', function (Blueprint $table) {
        $table->id('attempt_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('subject_id');
        $table->unsignedBigInteger('grade_id');
        $table->integer('duration')->nullable();
        $table->timestamp('attempt_date')->useCurrent();
        $table->decimal('score', 5, 2)->default(0);
        $table->integer('time_spent')->nullable();

        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
        $table->foreign('grade_id')->references('grade_id')->on('school_grades')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('quiz_attempts');
}
};
