<?php

use App\Models\Course;
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
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('MoreDetail');
            $table->foreignIdFor(Course::class)->constrained()->cascadeOnDelete();
            $table->unique(['course_id', 'user_id']);
            $table->unsignedSmallInteger('progress')->default(0);
            $table->double('perc_progress')->default(0);
            $table->unsignedSmallInteger('num_of_completed_quizes')->default(0);
            $table->timestamp('purchase_date')->useCurrent();
            $table->tinyInteger('rate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_user');
    }
};
