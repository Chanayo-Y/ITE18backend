<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('userID')->primary();
            $table->string('f_name');
            $table->string('m_name')->nullable();
            $table->string('l_name');
            $table->string('password');
            $table->string('email')->unique();
            $table->enum('gender', ['F', 'M'])->nullable();
            $table->string('address')->nullable();
            $table->string('phoneNum')->nullable();
            $table->string('roleID');
            $table->timestamps();
            $table->foreign('roleID')->references('roleID')->on('roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
