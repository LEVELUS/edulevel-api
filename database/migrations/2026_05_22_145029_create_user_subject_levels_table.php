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
    Schema::create('user_subject_levels', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('subject_id');
        $table->unsignedBigInteger('grade_id')->nullable();

        $table->primary(['user_id', 'subject_id']);

        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
        $table->foreign('grade_id')->references('grade_id')->on('school_grades')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::dropIfExists('user_subject_levels');
}
};
