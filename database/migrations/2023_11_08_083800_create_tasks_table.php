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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('description')->nullable();

            $table->datetime('request_at')->nullable();
            $table->datetime('dateline')->nullable();

            $table->string('client_id')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('assigned_by')->nullable();

            $table->string('status')->default(0);

            $table->string('file')->nullable();
            $table->datetime('extend_request')->nullable();

            $table->string('notify')->nullable();

            $table->string('type')->nullable();
            $table->string('main_id')->nullable();

            $table->string('extended')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
