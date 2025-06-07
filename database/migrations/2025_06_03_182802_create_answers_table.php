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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_user_id')->constrained('quiz_user');
            $table->foreignId('question_id')->constrained('questions');
            $table->unique(['quiz_user_id', 'question_id']);
            $table->enum('student_answer', ['a', 'b', 'c', 'd']);
            $table->boolean('is_correct');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
