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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)->constrained()->cascadeOnDelete();
            $table->string('title', 100);
            $table->string('video_url');
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('likes')->default(0);
            $table->double('rate')->nullable();
            $table->timestamp('publishing_request_date')->useCurrent();
            $table->dateTime('publishing_date')->nullable();
            $table->boolean('published')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
