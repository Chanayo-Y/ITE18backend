<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id('enrollmentID');
            $table->id('studentID');
            $table->integer('semester');
            $table->id('statusID');
            $table->id('schedID');
            $table->timestamps();
            $table->foreign('studentID')->references('studentID')->on('students')->onDelete('cascade');
            $table->foreign('statusID')->references('statusID')->on('status')->onDelete('cascade');
            $table->foreign('schedID')->references('schedID')->on('classscheds')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
