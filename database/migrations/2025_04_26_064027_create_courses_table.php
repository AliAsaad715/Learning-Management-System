<?php

use App\Enums\CourseStatusEnum;
use App\Enums\LevelEnum;
use App\Models\Topic;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description');
            $table->string('image_url');
            $table->foreignIdFor(Topic::class)->constrained();
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreignId('admin_id')->nullable()->references('id')->on('users');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->enum('difficulty_level', LevelEnum::values());
            $table->unsignedSmallInteger('total_of_time')->default(0);
            $table->double('price');
            $table->tinyInteger('rate')->default(0);
            $table->unsignedSmallInteger('num_of_episodes')->default(0);
            $table->unsignedInteger('num_of_students_enrolled')->default(0);
            $table->timestamp('publishing_request_date')->nullable();
            $table->datetime('publishing_date')->nullable();
            $table->enum('status', CourseStatusEnum::values())->default(CourseStatusEnum::DRAFT);
            $table->boolean('has_certificate')->default(false);
            $table->unsignedSmallInteger('total_quizzes')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
