<?php

use App\Enums\LevelEnum;
use App\Models\Language;
use App\Models\MoreDetail;
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
        Schema::create('language_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Language::class)->constrained();
            $table->foreignIdFor(MoreDetail::class)->constrained();
            $table->unique(['language_id', 'more_detail_id']);
            $table->enum('level', LevelEnum::values());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_user');
    }
};
