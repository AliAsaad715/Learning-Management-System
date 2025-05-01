<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = $tags = [
            // Subject Areas
            ['title' => "Mathematics"],
            ['title' => "Science"],
            ['title' => "History"],
            ['title' => "Literature"],
            ['title' => "Computer Science"],
            ['title' => "Engineering"],
            ['title' => "Business"],
            ['title' => "Arts"],
            ['title' => "Music"],
            ['title' => "Languages"],
            
            // Academic Levels
            ['title' => "Beginner"],
            ['title' => "Intermediate"],
            ['title' => "Advanced"],
            ['title' => "Introductory"],
            ['title' => "Graduate Level"],
            ['title' => "Undergraduate"],
            ['title' => "K-12"],
            ['title' => "High School"],
            ['title' => "Middle School"],
            ['title' => "Elementary"],
            
            // Skills
            ['title' => "Critical Thinking"],
            ['title' => "Problem Solving"],
            ['title' => "Writing"],
            ['title' => "Public Speaking"],
            ['title' => "Research Methods"],
            ['title' => "Data Analysis"],
            ['title' => "Programming"],
            ['title' => "Design Thinking"],
            ['title' => "Leadership"],
            ['title' => "Collaboration"],
            
            // Technology
            ['title' => "Web Development"],
            ['title' => "Mobile Development"],
            ['title' => "Data Science"],
            ['title' => "Artificial Intelligence"],
            ['title' => "Machine Learning"],
            ['title' => "Cybersecurity"],
            ['title' => "Cloud Computing"],
            ['title' => "Blockchain"],
            ['title' => "DevOps"],
            ['title' => "UI/UX Design"],
            
            // Business & Professional
            ['title' => "Entrepreneurship"],
            ['title' => "Marketing"],
            ['title' => "Finance"],
            ['title' => "Management"],
            ['title' => "Accounting"],
            ['title' => "Project Management"],
            ['title' => "Human Resources"],
            ['title' => "Sales"],
            ['title' => "Business Strategy"],
            ['title' => "Digital Marketing"],
            
            // Creative Arts
            ['title' => "Graphic Design"],
            ['title' => "Photography"],
            ['title' => "Video Production"],
            ['title' => "Creative Writing"],
            ['title' => "Drawing"],
            ['title' => "Painting"],
            ['title' => "3D Modeling"],
            ['title' => "Animation"],
            ['title' => "Game Design"],
            ['title' => "Film Making"],
            
            // Language Learning
            ['title' => "English"],
            ['title' => "Spanish"],
            ['title' => "French"],
            ['title' => "German"],
            ['title' => "Chinese"],
            ['title' => "Japanese"],
            ['title' => "Arabic"],
            ['title' => "Russian"],
            ['title' => "ESL"],
            ['title' => "TOEFL Preparation"],
            
            // Test Preparation
            ['title' => "SAT Prep"],
            ['title' => "ACT Prep"],
            ['title' => "GRE Prep"],
            ['title' => "GMAT Prep"],
            ['title' => "LSAT Prep"],
            ['title' => "MCAT Prep"],
            ['title' => "IELTS"],
            ['title' => "Certification Prep"],
            
            // Teaching Methods
            ['title' => "Project-Based Learning"],
            ['title' => "Flipped Classroom"],
            ['title' => "Gamification"],
            ['title' => "Blended Learning"],
            ['title' => "Microlearning"],
            ['title' => "Self-Paced"],
            ['title' => "Instructor-Led"],
            ['title' => "Peer Learning"],
            
            // Special Categories
            ['title' => "STEM"],
            ['title' => "STEAM"],
            ['title' => "Coding for Kids"],
            ['title' => "Financial Literacy"],
            ['title' => "Career Development"],
            ['title' => "Personal Growth"],
            ['title' => "Mindfulness"],
            ['title' => "Special Education"],
            ['title' => "Gifted Education"],
            ['title' => "Adult Education"]
        ];

        foreach($tags as $tag)
        Tag::create($tag);
    }
}
