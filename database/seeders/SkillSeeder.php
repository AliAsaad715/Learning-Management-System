<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // ----- Programming Languages -----
            ['title' => 'HTML'],
            ['title' => 'CSS'],
            ['title' => 'JavaScript'],
            ['title' => 'TypeScript'],
            ['title' => 'Python'],
            ['title' => 'Java'],
            ['title' => 'C++'],
            ['title' => 'C#'],
            ['title' => 'PHP'],
            ['title' => 'Ruby'],
            ['title' => 'Swift'],
            ['title' => 'Kotlin'],
            ['title' => 'Go'],
            ['title' => 'Rust'],
        
            // ----- Databases -----
            ['title' => 'SQL'],
            ['title' => 'NoSQL'],
            ['title' => 'MySQL'],
            ['title' => 'PostgreSQL'],
            ['title' => 'MongoDB'],
        
            // ----- Frontend Frameworks/Libraries -----
            ['title' => 'React'],
            ['title' => 'Angular'],
            ['title' => 'Vue.js'],
            ['title' => 'Svelte'],
        
            // ----- Backend Frameworks -----
            ['title' => 'Node.js'],
            ['title' => 'Django'],
            ['title' => 'Flask'],
            ['title' => 'Laravel'],
            ['title' => 'Spring Boot'],
        
            // ----- DevOps & Cloud -----
            ['title' => 'Git'],
            ['title' => 'Docker'],
            ['title' => 'Kubernetes'],
            ['title' => 'AWS'],
            ['title' => 'Azure'],
            ['title' => 'Google Cloud'],
        
            // ----- APIs & Web Services -----
            ['title' => 'RESTful APIs'],
            ['title' => 'GraphQL'],
        
            // ----- Data Science & AI/ML -----
            ['title' => 'Machine Learning'],
            ['title' => 'Data Science'],
            ['title' => 'TensorFlow'],
            ['title' => 'PyTorch'],
            ['title' => 'Pandas'],
            ['title' => 'NumPy'],
        
            // ----- Cybersecurity & Blockchain -----
            ['title' => 'Cybersecurity'],
            ['title' => 'Ethical Hacking'],
            ['title' => 'Blockchain'],
            ['title' => 'Solidity'],
        
            // ----- Game Development -----
            ['title' => 'Unity'],
            ['title' => 'Unreal Engine'],
        
            // ----- Soft Skills -----
            ['title' => 'Communication'],
            ['title' => 'Teamwork'],
            ['title' => 'Leadership'],
            ['title' => 'Problem Solving'],
            ['title' => 'Critical Thinking'],
            ['title' => 'Time Management'],
            ['title' => 'Creativity'],
            ['title' => 'Adaptability'],
            ['title' => 'Emotional Intelligence'],
            ['title' => 'Public Speaking'],
            ['title' => 'Writing'],
            ['title' => 'Presentation'],
            ['title' => 'Negotiation'],
            ['title' => 'Project Management'],
            ['title' => 'Research'],
            ['title' => 'Analytical Skills'],
            ['title' => 'Attention to Detail'],
            ['title' => 'Collaboration'],
        
            // ----- Education & E-Learning -----
            ['title' => 'Curriculum Development'],
            ['title' => 'E-Learning'],
            ['title' => 'Instructional Design'],
            ['title' => 'Pedagogy'],
            ['title' => 'Classroom Management'],
            ['title' => 'Student Engagement'],
            ['title' => 'Assessment Design'],
            ['title' => 'Educational Technology'],
            ['title' => 'Moodle'],
            ['title' => 'Blackboard'],
            ['title' => 'Canvas LMS'],
            ['title' => 'Teaching'],
            ['title' => 'Tutoring'],
            ['title' => 'STEM Education'],
            ['title' => 'Literacy Development'],
            ['title' => 'Special Education'],
        ];

        foreach($skills as $skill)
        Skill::create($skill);
    }
}
