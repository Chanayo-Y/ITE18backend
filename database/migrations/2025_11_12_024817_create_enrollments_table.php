<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->string('enrollmentID')->primary();
            $table->string('studentID');
            $table->integer('semester');
            $table->string('statusID');
            $table->string('schedID');
            $table->timestamps();
            $table->foreign('studentID')->references('studentID')->on('students')->onDelete('cascade');
            $table->foreign('statusID')->references('statusID')->on('status')->onDelete('cascade');
            $table->foreign('schedID')->references('schedID')->on('class_scheds')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
