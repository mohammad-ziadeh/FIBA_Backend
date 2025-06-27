<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('role', ['player', 'coach', 'admin'])->default('player');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('birth_date')->nullable();
            $table->integer('points')->default(0);
            $table->string('avatar_url')->nullable();
            $table->string('background_url')->nullable();
            $table->string('name')->nullable();
            $table->integer('phone')->nullable();
            $table->string('email')->unique();
            $table->softDeletes();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
