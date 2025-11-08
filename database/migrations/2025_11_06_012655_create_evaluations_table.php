<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id('evaluaID');
            $table->id('studentID');
            $table->id('rateID');
            $table->id('employeeID');
            $table->foreign('studentID')->references('studentID')->on('students')->onDelete('cascade');
            $table->foreign('rateID')->references('rateID')->on('ratings')->onDelete('cascade');
            $table->foreign('employeeID')->references('employeeID')->on('employees')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
