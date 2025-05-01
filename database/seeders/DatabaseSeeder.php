<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\LevelEnum;
use App\Enums\RoleEnum;
use App\Models\Badge;
use App\Models\Category;
use App\Models\Country;
use App\Models\Course;
use App\Models\Language;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BadgeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(JobTitleSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(StatisticsSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(TopicSeeder::class);

        $user = User::create(['first_name' =>'Omar', 'last_name' => 'Aldalati', 'job_title_id' => '1','country_id' => '1', 'email' => 'omaraldalati3@gmail.com', 'password' => '123','education' => 'elementary','role' => RoleEnum::TEACHER]);
        $course = Course::create([
            'title' => 'hello', 
            'topic_id' => 1,
            'teacher_id' => 1,
            'difficulty_level' => LevelEnum::INTERMEDIATE,
            'num_of_hours' => 10,
            'num_of_episodes' => 10,
        ]);
        
    }
}
