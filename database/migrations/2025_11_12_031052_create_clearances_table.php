<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clearances', function (Blueprint $table) {
            $table->string('clearanceID')->primary();
            $table->string('studentID');
            $table->string('statusID');
            $table->string('deptID');
             $table->timestamps();
            $table->foreign('studentID')->references('studentID')->on('students')->onDelete('cascade');
            $table->foreign('statusID')->references('statusID')->on('status')->onDelete('cascade');
            $table->foreign('deptID')->references('deptID')->on('departments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
