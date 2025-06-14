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
            'goal' => 20,
            'image_url' => 'Flame_Keeper.jpg',
            'admin_id' => 1
          ],
          [
            'group' => 'Flame',
            'level' => 2,
            'description' => 'Keep on your spark for 50 days',
            'goal' => 50,
            'image_url' => 'Persistent_Flame.jpg',
            'admin_id' => 1
          ],
          [
            'group' => 'Flame',
            'level' => 3,
            'description' => 'Keep on your spark for 100 days',
            'goal' => 100,
            'image_url' => 'Century_Flame.jpg',
            'admin_id' => 1
          ],
          [
            'group' => 'Total Courses',
            'level' => 1,
            'description' => 'Complete 5 courses in total',
            'goal' => 5,
            'image_url' => 'Rising_Scholar.jpg',
            'admin_id' => 1
          ],
          [
            'group' => 'Total Courses',
            'level' => 2,
            'description' => 'Complete 15 courses in total',
            'goal' => 15,
            'image_url' => 'The_Tenacios_Learner.jpg',
            'admin_id' => 1
          ],
          [
            'group' => 'Total Courses',
            'level' => 3,
            'description' => 'Complete 25 courses in total',
            'goal' => 25,
            'image_url' => 'Crown_of_Knowledge.jpg',
            'admin_id' => 1
          ],
          [
            'group' => 'Total Courses in one topic',
            'level' => 1,
            'description' => 'Complete 3 courses in one topic',
            'goal' => 3,
            'image_url' => 'Topic_Explorer.jpg',
            'admin_id' => 1
          ],
          [
            'group' => 'Total Courses in one topic',
            'level' => 2,
            'description' => 'Complete 5 courses in one topic',
            'goal' => 5,
            'image_url' => 'Halfway_Expert.jpg',
            'admin_id' => 1
          ],
          [
            'group' => 'Total Courses in one topic',
            'level' => 3,
            'description' => 'Complete 10 courses in one topic',
            'goal' => 10,
            'image_url' => 'The_Grand_Scholar.jpg',
            'admin_id' => 1
          ],
        ];

        foreach($badges as $badge)
            Badge::create($badge);
    }
}
