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
        Schema::create('user_exercise_word_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained('exercises')->onDelete('cascade');
            $table->foreignId('user_exercise_result_id')->constrained('user_exercise_results')->onDelete('cascade');
            $table->string('word_en');
            $table->string('word_ru');
            $table->string('answer')->nullable();
            $table->boolean('correct_answer')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_exercise_word_results');
    }
};
