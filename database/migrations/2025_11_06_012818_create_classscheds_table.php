<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_scheds', function (Blueprint $table) {
            $table->id('schedID');
            $table->id('employeeID');
            $table->id('roomID');
            $table->id('subjectID');
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
