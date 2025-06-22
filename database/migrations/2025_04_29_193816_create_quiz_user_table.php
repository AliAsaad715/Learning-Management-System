<?php

use App\Models\Quiz;
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
        Schema::create('quiz_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Quiz::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->unsignedTinyInteger('mark')->default(0);
            $table->boolean('success')->nullable();
            $table->decimal('percentage_mark', 5, 2)->default(0);
            $table->timestamp('quiz_submission_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_user');
    }
};
