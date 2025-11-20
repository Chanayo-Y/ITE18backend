<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->string('balanceID')->primary();
            $table->string('studentID');
            $table->float('amount');
            $table->string('statusID');
            $table->timestamps();
            $table->foreign('studentID')->references('studentID')->on('students')->onDelete('cascade');
            $table->foreign('statusID')->references('statusID')->on('status')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
