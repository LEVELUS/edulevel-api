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
    Schema::create('school_grades', function (Blueprint $table) {
        $table->id('grade_id');
        $table->string('grade_name', 100);
    });
}

public function down(): void
{
    Schema::dropIfExists('school_grades');
}
};
