<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = [
            // Category 1: Mathematics and Sciences
            ['title' => 'Mathematics', 'category_id' => 1],
            ['title' => 'Science', 'category_id' => 1],
            ['title' => 'History', 'category_id' => 1],
            ['title' => 'Literature','category_id' => 1],
            ['title' => 'Engineering', 'category_id' => 1],
            ['title' => 'Algebra', 'category_id' => 1],
            ['title' => 'Geometry', 'category_id' => 1],
            ['title' => 'Calculus', 'category_id' => 1],
            ['title' => 'Statistics', 'category_id' => 1],
            ['title' => 'Biology', 'category_id' => 1],
            ['title' => 'Chemistry', 'category_id' => 1],
            ['title' => 'Physics', 'category_id' => 1],
            ['title' => 'Earth Science', 'category_id' => 1],
            ['title' => 'Astronomy', 'category_id' => 1],
        
            // Category 2: Computer Science and Technology
            ['title' => 'Computer Sience', 'category_id' => 2],
            ['title' => 'Programming Fundamentals', 'category_id' => 2],
            ['title' => 'Web Development', 'category_id' => 2],
            ['title' => 'Mobile App Development', 'category_id' => 2],
            ['title' => 'Problem Solving', 'category_id' => 2],
            ['title' => 'Data Science', 'category_id' => 2],
            ['title' => 'Machine Learning', 'category_id' => 2],
            ['title' => 'Artificial Intelligence', 'category_id' => 2],
            ['title' => 'Cybersecurity', 'category_id' => 2],
            ['title' => 'Cloud Computing', 'category_id' => 2],
            ['title' => 'Blockchain', 'category_id' => 2],
            ['title' => 'Game Development', 'category_id' => 2],
            ['title' => 'UI/UX Design', 'category_id' => 2],
            ['title' => 'DevOps', 'category_id' => 2],
        
            // Category 3: Humanities and Social Sciences
            ['title' => 'World History', 'category_id' => 3],
            ['title' => 'U.S. History', 'category_id' => 3],
            ['title' => 'European History', 'category_id' => 3],
            ['title' => 'Political Science', 'category_id' => 3],
            ['title' => 'Psychology', 'category_id' => 3],
            ['title' => 'Sociology', 'category_id' => 3],
            ['title' => 'Philosophy', 'category_id' => 3],
            ['title' => 'Anthropology', 'category_id' => 3],
            ['title' => 'Economics', 'category_id' => 3],
            ['title' => 'Geography', 'category_id' => 3],
        
            // Category 4: Business and Professional Development
            ['title' => 'Entrepreneurship', 'category_id' => 4],
            ['title' => 'Marketing', 'category_id' => 4],
            ['title' => 'Digital Marketing', 'category_id' => 4],
            ['title' => 'Financial Literacy', 'category_id' => 4],
            ['title' => 'Project Management', 'category_id' => 4],
            ['title' => 'Business Communication', 'category_id' => 4],
            ['title' => 'Human Resources', 'category_id' => 4],
            ['title' => 'Accounting', 'category_id' => 4],
            ['title' => 'E-commerce', 'category_id' => 4],
        
            // Category 5: Creative Arts and Design
            ['title' => 'Graphic Design', 'category_id' => 5],
            ['title' => 'Digital Art', 'category_id' => 5],
            ['title' => 'Photography', 'category_id' => 5],
            ['title' => 'Creative Writing', 'category_id' => 5],
            ['title' => 'Music Theory', 'category_id' => 5],
            ['title' => 'Film Production', 'category_id' => 5],
            ['title' => 'Animation', 'category_id' => 5],
            ['title' => 'Interior Design', 'category_id' => 5],
            ['title' => 'Fashion Design', 'category_id' => 5],
            ['title' => 'Architecture', 'category_id' => 5],
            ['title' => '3D Modeling', 'category_id' => 5],
            ['title' => 'Game Design', 'category_id' => 5],
        
            // Category 6: Languages and Linguistics
            ['title' => 'English Language', 'category_id' => 6],
            ['title' => 'Spanish Language', 'category_id' => 6],
            ['title' => 'French Language', 'category_id' => 6],
            ['title' => 'German Language', 'category_id' => 6],
            ['title' => 'Chinese Language', 'category_id' => 6],
            ['title' => 'Japanese Language', 'category_id' => 6],
            ['title' => 'Arabic Language', 'category_id' => 6],
            ['title' => 'Sign Language', 'category_id' => 6],
            ['title' => 'Linguistics', 'category_id' => 6],
            ['title' => 'Translation Studies', 'category_id' => 6],
        
            // Category 7: Test Preparation and Academic Skills
            ['title' => 'SAT Preparation', 'category_id' => 7],
            ['title' => 'ACT Preparation', 'category_id' => 7],
            ['title' => 'GRE Preparation', 'category_id' => 7],
            ['title' => 'GMAT Preparation', 'category_id' => 7],
            ['title' => 'IELTS Preparation', 'category_id' => 7],
            ['title' => 'TOEFL Preparation', 'category_id' => 7],
            ['title' => 'MCAT Preparation', 'category_id' => 7],
            ['title' => 'LSAT Preparation', 'category_id' => 7],
            ['title' => 'Certification Exams', 'category_id' => 7],
            ['title' => 'College Admissions', 'category_id' => 7],
        
            // Category 8: Life Skills and Personal Development
            ['title' => 'Time Management', 'category_id' => 8],
            ['title' => 'Public Speaking', 'category_id' => 8],
            ['title' => 'Research Methods', 'category_id' => 8],
            ['title' => 'Data Analysis', 'category_id' => 8],
            ['title' => 'Design Thinking', 'category_id' => 8],
            ['title' => 'Leadership', 'category_id' => 8],
            ['title' => 'Collaboration', 'category_id' => 8],
            ['title' => 'Writing', 'category_id' => 8],
            ['title' => 'Mindfulness', 'category_id' => 8],
            ['title' => 'Nutrition', 'category_id' => 8],
            ['title' => 'Fitness', 'category_id' => 8],
            ['title' => 'Personal Finance', 'category_id' => 8],
            ['title' => 'Parenting', 'category_id' => 8],
            ['title' => 'Relationships', 'category_id' => 8],
            ['title' => 'Career Development', 'category_id' => 8],
            ['title' => 'Study Skills', 'category_id' => 8],
            ['title' => 'Critical Thinking', 'category_id' => 8]
        ];

        foreach($topics as $topic)
        Topic::create($topic);
    }
}
