<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->string('gradeID')->primary();
            $table->string('subjectID');
            $table->float('grade');
            $table->timestamps();
            $table->foreign('subjectID')->references('subjectID')->on('subjects')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
