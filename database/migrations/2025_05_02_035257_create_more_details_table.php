<?php

use App\Enums\EducationEnum;
use App\Models\Country;
use App\Models\JobTitle;
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
        Schema::create('more_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(JobTitle::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Country::class)->constrained();
            $table->string('linked_in_url', )->nullable();
            $table->enum('education',EducationEnum::values())->default(EducationEnum::NONE);
            $table->string('university')->nullable();
            $table->string('speciality')->nullable();
            $table->text('work_experience', 1000)->nullable();
            $table->boolean('is_banned')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('more_details');
    }
};
