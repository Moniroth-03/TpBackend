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
            $table->string('title');
            $table->unsignedBigInteger('assignee');
            $table->unsignedBigInteger('category_id');
            $table->date('due_date');
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
        });

        Schema::table('tasks', function (Blueprint $table) {
            // Define foreign key constraints
            $table->foreign('assignee')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
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

