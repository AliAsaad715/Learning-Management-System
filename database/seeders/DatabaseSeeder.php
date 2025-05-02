<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
    }
}
