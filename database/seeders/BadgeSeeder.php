<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $badges = [
          [
            'group' => 'Flame',
            'level' => 1,
            'description' => 'Keep on your spark for 20 days',
            'goal' => 20
          ],
          [
            'group' => 'Flame',
            'level' => 2,
            'description' => 'Keep on your spark for 50 days',
            'goal' => 50
          ],
          [
            'group' => 'Flame',
            'level' => 3,
            'description' => 'Keep on your spark for 100 days',
            'goal' => 100
          ],
          [
            'group' => 'Total Courses',
            'level' => 1,
            'description' => 'Complete 5 courses in total',
            'goal' => 5
          ],
          [
            'group' => 'Total Courses',
            'level' => 2,
            'description' => 'Complete 15 courses in total',
            'goal' => 15
          ],
          [
            'group' => 'Total Courses',
            'level' => 3,
            'description' => 'Complete 25 courses in total',
            'goal' => 25
          ],
          [
            'group' => 'Total Courses in one topic',
            'level' => 1,
            'description' => 'Complete 3 courses in one topi',
            'goal' => 3
          ],
          [
            'group' => 'Total Courses in one topic',
            'level' => 2,
            'description' => 'Complete 5 courses in one topic',
            'goal' => 5
          ],
          [
            'group' => 'Total Courses in one topic',
            'level' => 3,
            'description' => 'Complete 10 courses in one topic',
            'goal' => 10
          ],
        ];

        foreach($badges as $badge)
        Badge::create($badge);

       
    }
}
