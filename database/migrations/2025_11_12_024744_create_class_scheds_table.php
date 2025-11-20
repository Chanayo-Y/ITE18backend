<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_scheds', function (Blueprint $table) {
            $table->string('schedID')->primary();
            $table->string('employeeID');
            $table->string('roomID');
            $table->string('subjectID');
            $table->timestamps();
            $table->foreign('employeeID')->references('employeeID')->on('employees')->onDelete('cascade');
            $table->foreign('roomID')->references('roomID')->on('rooms')->onDelete('cascade');
            $table->foreign('subjectID')->references('subjectID')->on('subjects')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classscheds');
    }
};
