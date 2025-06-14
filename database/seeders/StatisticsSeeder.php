<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statistics = [
            ['title' => 'Current Enthusiasm'],
            ['title' => 'Max Enthusiasm'],
            ['title' => 'Total Completed Courses'],
            ['title' => 'Max Of Total Completed Courses In One Topic'],
            ['title' => 'Published Courses'],
            ['title' => 'Granted Likes'],
            ['title' => 'Acquired Likes'],
            ['title' => 'Acquired Views'],
            ['title' => 'Num Of Certificates'],
            ['title' => 'Num Of Badges'],
            ['title' => 'Num Of Bronze Badges'],
            ['title' => 'Num Of Silver Badges'],
            ['title' => 'Num Of Gold Badges'],
        ];

        foreach($statistics as $statistic)
            Statistic::create($statistic);
    }
}
