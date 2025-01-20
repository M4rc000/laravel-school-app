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
            $table->foreignId('role_id');
            $table->string('picture')->default('profile-img/default.jpg');
            $table->string('google_id')->nullable();
            $table->string('batch')->nullable();
            $table->string('name');
            $table->string('country')->nullable();
            $table->string('birth_of_place')->nullable();
            $table->char('gender')->nullable();
            $table->string('birth_of_date')->nullable();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('is_active');
            $table->rememberToken();
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
