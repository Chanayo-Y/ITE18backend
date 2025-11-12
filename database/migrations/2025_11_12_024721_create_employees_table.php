<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->string('employeeID')->primary();
            $table->string('deptID');
            $table->string('position');
            $table->string('userID');
            $table->timestamps();
            $table->foreign('deptID')->references('deptID')->on('departments')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
