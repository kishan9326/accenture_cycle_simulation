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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('session_id');
            $table->string('gaming_mode');
            $table->string('environment');
            $table->string('player_count');
            $table->string('name');
            $table->string('email');
            $table->string('organization')->nullable();
            $table->enum('age', ['18-24', '25-34', '35-44', '45-54', '55-70'])->default("25-34");
            $table->enum('gender', ['male', 'female', 'other'])->default('other');
            $table->string('userFile')->nullable();
            $table->integer('calories')->nullable();
            $table->string('timer')->nullable();
            $table->integer('timer_in_sec')->nullable();
            $table->integer('correct_answers')->nullable();
            $table->enum('player_status', ['active', 'inactive', 'deleted'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
