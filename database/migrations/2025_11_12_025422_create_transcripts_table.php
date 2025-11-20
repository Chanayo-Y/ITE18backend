<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transcripts', function (Blueprint $table) {
            $table->string('transcriptID')->primary();
            $table->string('gradeID');
            $table->string('studentID');
            $table->timestamps();
            $table->foreign('gradeID')->references('gradeID')->on('grades')->onDelete('cascade');
            $table->foreign('studentID')->references('studentID')->on('students')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transcripts');
    }
};
