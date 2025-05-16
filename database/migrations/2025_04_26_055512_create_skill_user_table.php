<?php

use App\Models\MoreDetail;
use App\Models\Skill;
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
        Schema::create('skill_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Skill::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(MoreDetail::class)->constrained();
            $table->unique(['skill_id', 'more_detail_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_user');
    }
};
