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
            ['id' => 1, 'title' => 'Mathematics and Sciences'],
            ['id' => 2, 'title' => 'Computer Science and Technology'],
            ['id' => 3, 'title' => 'Humanities and Social Sciences'],
            ['id' => 4, 'title' => 'Business and Professional Development'],
            ['id' => 5, 'title' => 'Creative Arts and Design'],
            ['id' => 6, 'title' => 'Languages and Linguistics'],
            ['id' => 7, 'title' => 'Test Preparation and Academic Skills'],
            ['id' => 8, 'title' => 'Life Skills and Personal Development']
        ];
        
        foreach ($categories as $category)
        Category::create($category);
    }
}
