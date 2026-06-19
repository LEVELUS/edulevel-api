<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('series_id');
            $table->string('series_name', 150);
            $table->string('code', 20)->nullable();
            $table->unsignedBigInteger('grade_id');

            $table->foreign('grade_id')
                  ->references('grade_id')->on('school_grades')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};