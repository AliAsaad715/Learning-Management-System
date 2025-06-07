<?php

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
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->foreignIdFor(Topic::class)->constrained();
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->enum('difficulty_level', LevelEnum::values());
            $table->unsignedSmallInteger('num_of_hours');
            $table->double('price')->nullable();
            $table->tinyInteger('rate')->default(0);
            $table->unsignedSmallInteger('num_of_episodes');
            $table->timestamp('publishing_request_date')->useCurrent();
            $table->datetime('publishing_date')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('has_certificate')->default(false);
            $table->unsignedSmallInteger('total_quizes')->default(0);
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
