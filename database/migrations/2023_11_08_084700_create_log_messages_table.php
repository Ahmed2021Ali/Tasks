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
        Schema::create('log_messages', function (Blueprint $table) {
            $table->id();
            $table->string('task_id')->nullable();
            $table->string('message')->nullable();
            $table->string('client_id')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('assigned_by')->nullable();
            $table->string('status')->nullable();
            $table->string('main_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_messages');
    }
};
