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
        Schema::create('role_access_submenu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id');
            $table->string('name');
            $table->string('icon');
            $table->string('url');
            $table->string('is_active');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_access_submenu');
    }
};
