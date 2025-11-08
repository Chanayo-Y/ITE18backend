<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clearances', function (Blueprint $table) {
            $table->id('clearanceID');
            $table->id('studentID');
            $table->id('statusID');
            $table->id('departmentID');
            $table->foreign('studentID')->references('studentID')->on('students')->onDelete('cascade');
            $table->foreign('statusID')->references('statusID')->on('status')->onDelete('cascade');
            $table->foreign('departmentID')->references('departmentID')->on('departments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
