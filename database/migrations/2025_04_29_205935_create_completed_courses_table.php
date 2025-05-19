<?php

use App\Models\Topic;
use App\Models\User;
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
        Schema::create('completed_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Topic::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->unique('topic_id', 'user_id');
            $table->unsignedSmallInteger('progress')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed_courses');
    }
};
