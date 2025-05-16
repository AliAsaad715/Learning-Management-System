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

        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizes') VALUES
        ('1', 'Laravel for Beginner', 'Laravel course that explains the basics of back-end concepts', '2', '1', 'beginner', '23', '0', '20', '2004-08-23', '2005-08-23', 'true', '1', 'false', '0');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizes') VALUES
        ('2', 'Laravel for Intermediate', 'Laravel course that explains the intermediate concepts of back-end', '2', '1', 'intermediate', '19', '0', '10', '2004-08-23', '2005-08-23', 'true', '1', 'false', '2');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizes') VALUES
        ('3', 'Laravel for advanced', 'Laravel course that explains advanced concepts of back-end', '2', '1', 'advanced', '40', '0', '34', '2004-08-23', '2005-08-23', 'true', '1', 'false', '5');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizes') VALUES
        ('4', 'Laravel for experts', 'Laravel course that explains experts concepts of back-end', '2', '1', 'expert', '33', '0', '53', '2004-08-23', '2005-08-23', 'true', '1', 'false', '8');
        ");
    }
}
