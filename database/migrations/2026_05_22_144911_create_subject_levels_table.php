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
    Schema::create('subject_levels', function (Blueprint $table) {
        $table->unsignedBigInteger('subject_id');
        $table->unsignedBigInteger('grade_id');

        $table->primary(['subject_id', 'grade_id']);

        $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
        $table->foreign('grade_id')->references('grade_id')->on('school_grades')->onDelete('cascade');
    });
    }

public function down(): void
    {
    Schema::dropIfExists('subject_levels');
    }
};
