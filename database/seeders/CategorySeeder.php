<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'title' => 'Mathematics and Sciences',
                'image_url' => 'sience_and_math.jpg'],
            [
                'id' => 2,
                'title' => 'Computer Science and Technology',
                'image_url' => 'computer_science_and_technology.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Humanities and Social Sciences',
                'image_url' => 'humanities_and_social_sciences.png'
            ],
            [
                'id' => 4,
                'title' => 'Business and Professional Development',
                'image_url' => 'business_and_professional_development.png'
            ],
            [
                'id' => 5,
                'title' => 'Creative Arts and Design',
                'image_url' => 'creative_arts_and_design.jpg'
            ],
            [
                'id' => 6,
                'title' => 'Languages and Linguistics',
                'image_url' => 'languages_and_linguistics.png'
            ],
            [
                'id' => 7,
                'title' => 'Test Preparation and Academic Skills',
                'image_url' => 'test_preparation_and_academic_skills.png'
            ],
            [
                'id' => 8,
                'title' => 'Life Skills and Personal Development',
                'image_url' => 'life_skills_and_personal_development.png'
            ]
        ];

        foreach ($categories as $category)
            Category::create($category);
    }
}
