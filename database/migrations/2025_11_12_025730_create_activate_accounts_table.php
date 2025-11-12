<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activate_accounts', function (Blueprint $table) {
            $table->string('activateID')->primary();
            $table->string('activated_at');
            $table->string('studentID');
            $table->timestamps();
            $table->foreign('studentID')->references('studentID')->on('students')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activate_accounts');
    }
};
