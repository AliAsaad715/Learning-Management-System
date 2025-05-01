<?php

namespace Database\Seeders;

use App\Models\JobTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobTitles = [
            ['title' => 'Student'],
            ['title' => 'Teacher'],
            ['title' => 'Professor'],
            ['title' => 'Lecturer'],
            ['title' => 'Teaching Assistant'],
            ['title' => 'Tutor'],
            ['title' => 'Instructor'],
            ['title' => 'Curriculum Developer'],
            ['title' => 'Instructional Designer'],
            ['title' => 'Education Consultant'],
            ['title' => 'School Administrator'],
            ['title' => 'Principal'],
            ['title' => 'Vice Principal'],
            ['title' => 'Dean'],
            ['title' => 'Academic Advisor'],
            ['title' => 'Guidance Counselor'],
            ['title' => 'Special Education Teacher'],
            ['title' => 'ESL Teacher'],
            ['title' => 'STEM Educator'],
            ['title' => 'E-Learning Specialist'],
            ['title' => 'EdTech Developer'],
            ['title' => 'Online Course Creator'],
            ['title' => 'Researcher'],
            ['title' => 'PhD Candidate'],
            ['title' => 'Postdoctoral Fellow'],
            ['title' => 'Librarian'],
            ['title' => 'Education Technologist'],
            ['title' => 'School Psychologist'],
            ['title' => 'Education Policy Analyst'],
            ['title' => 'Corporate Trainer'],
            ['title' => 'Workshop Facilitator'],
            ['title' => 'Mentor'],
            ['title' => 'Coach'],
            ['title' => 'Freelance Educator'],
            ['title' => 'Homeschool Teacher'],
            ['title' => 'Teaching Fellow'],
            ['title' => 'Graduate Assistant'],
            ['title' => 'Adjunct Professor'],
            ['title' => 'Department Head'],
            ['title' => 'Chancellor'],
        ];

        foreach($jobTitles as $jobTitle)
        JobTitle::create($jobTitle);
    }
}
