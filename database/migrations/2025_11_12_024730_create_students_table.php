<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('studentID')->primary();
            $table->string('programID');
            $table->string('yearID');
            $table->string('userID');
            $table->timestamps();
            $table->foreign('programID')->references('programID')->on('programs')->onDelete('cascade');
            $table->foreign('yearID')->references('yearID')->on('years')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
