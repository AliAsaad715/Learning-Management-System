<?php

namespace Database\Seeders;


use App\Models\MoreDetail;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //teacher
        User::create([
            'id' => 2,
            'first_name' => 'Tahsin',
            'last_name' => 'abo sherko',
            'email' => 'tahsin@gmail.com',
            'password' => '147258369',
            'role' => 'teacher',
        ]);

        $MoreDetail = MoreDetail::create([
            'id' => 1,
            'user_id' =>  2,
            'job_title_id' => 2,
            'country_id' => 3,
            'education' => 'none',
        ]);


        //student
        User::create([
            'id' => 3,
            'first_name' => 'Omar',
            'last_name' => 'Od',
            'email' => 'Omar@gmail.com',
            'password' => '147258369',
            'role' => 'student',
        ]);

        MoreDetail::create([
            'id' => 2,
            'user_id' =>  3,
            'job_title_id' => 2,
            'country_id' => 10,
            'education' => 'none',
        ]);

        //courses
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizzes') VALUES
        ('1', 'Laravel for Beginner', 'Laravel course that explains the basics of back-end concepts', '2', '1', 'beginner', '23', '0', '20', '2004-08-23', '2005-08-23', 'true', '1', 'false', '0');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizzes') VALUES
        ('2', 'Laravel for Intermediate', 'Laravel course that explains the intermediate concepts of back-end', '2', '1', 'intermediate', '19', '0', '10', '2004-08-23', '2005-08-23', 'true', '1', 'false', '2');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizzes') VALUES
        ('3', 'Laravel for advanced', 'Laravel course that explains advanced concepts of back-end', '2', '1', 'advanced', '40', '0', '34', '2004-08-23', '2005-08-23', 'true', '1', 'false', '5');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizzes') VALUES
        ('4', 'Laravel for experts', 'Laravel course that explains experts concepts of back-end', '2', '1', 'expert', '33', '0', '53', '2004-08-23', '2005-08-23', 'true', '1', 'false', '8');
        ");

        //episodes for course 1
        DB::insert("INSERT INTO 'episodes' ('id', 'course_id', 'title', 'video_url', 'published') VALUES
        ('1', '1', 'Ep 01 - Hello, Laravel', 'https://youtu.be/1NjOWtQ7S2o?si=hvMiLuAF7eBDTosJ', 'false');
        ");

        DB::insert("INSERT INTO 'episodes' ('id', 'course_id', 'title', 'video_url', 'published') VALUES
        ('2', '1', 'Ep 02 - Your First Route and View', 'https://youtu.be/KHxGAOv2Emc?si=9xcl9gHgt2nEI76J', 'false');
        ");

        DB::insert("INSERT INTO 'episodes' ('id', 'course_id', 'title', 'video_url', 'published') VALUES
        ('3', '1', 'Ep 03 - Create a Layout File Using Blade Components', 'https://youtu.be/H5R3vV38QiM?si=9UXDpmGJtwXczTcN', 'false');
        ");

        DB::insert("INSERT INTO 'episodes' ('id', 'course_id', 'title', 'video_url', 'published') VALUES
        ('4', '1', '30 Days to Learn Laravel, Ep 04 - Make a Pretty Layout Using Tailwind CSS', 'https://youtu.be/37QPJZ1la2g?si=GF5o9Kas2rElYRSA', 'false');
        ");
    }
}
