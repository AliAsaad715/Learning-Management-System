<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Episode;
use App\Models\MoreDetail;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Reply;
use App\Models\Skill;
use App\Models\User;
//use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
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
        $user1 = User::create([
            'id' => 2,
            'first_name' => 'Tahsin',
            'last_name' => 'abo sherko',
            'email' => 'tahsin@gmail.com',
            'password' => '147258369',
            'role' => 'teacher',
        ]);

        $MoreDetail1 = MoreDetail::create([
            'id' => 1,
            'user_id' =>  2,
            'job_title_id' => 2,
            'country_id' => 3,
            'education' => 'none',
        ]);

        $user1->badges()->attach([1,2,5]);
        $MoreDetail1->skills()->attach([2,3,4]);
        $MoreDetail1->languages()->attach(2, ['level' => 'mother_tongue']);
        $MoreDetail1->languages()->attach(5, ['level' => 'beginner']);

        //student
        $user2 = User::create([
            'id' => 3,
            'first_name' => 'Omar',
            'last_name' => 'Od',
            'profile_image_url' => 'personal_img.jpg',
            'email' => 'Omar@gmail.com',
            'password' => '147258369',
            'role' => 'student',
        ]);

        $MoreDetail2 = MoreDetail::create([
            'id' => 2,
            'user_id' =>  3,
            'job_title_id' => 2,
            'country_id' => 10,
            'education' => 'none',
        ]);


        $user2->badges()->attach([1,2,5]);
        $MoreDetail2->skills()->attach([2,3,4]);
        $MoreDetail2->languages()->attach(3, ['level' => 'mother_tongue']);
        $MoreDetail2->languages()->attach(2, ['level' => 'beginner']);

        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'rate', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'has_certificate', 'total_quizes') VALUES
        ('1', 'Laravel for Beginner', 'Laravel course that explains the basics of back-end concepts', 'course1.png', '2', '2', 'beginner', '23', '0', '4', '20', '2004-08-23', '2005-08-23', 'true', 'true', '0');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'rate', 'num_of_episodes', 'publishing_request_date', 'deleted_at', 'published', 'has_certificate', 'total_quizes') VALUES
        ('2', 'Laravel for Intermediate', 'Laravel course that explains the intermediate concepts of back-end', 'course2.png', '2', '2', 'intermediate', '19', '10', '3', '10', '2004-08-23', '2005-08-23', 'false', 'false', '2');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'rate', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'has_certificate', 'total_quizes') VALUES
        ('3', 'Laravel for advanced', 'Laravel course that explains advanced concepts of back-end', 'course3.png', '2', '2', 'advanced', '40', '32', '2', '34', '2004-08-23', '2004-08-23', 'false', 'false', '5');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'has_certificate', 'total_quizes') VALUES
        ('4', 'Laravel for experts', 'Laravel course that explains experts concepts of back-end', 'course4.png', '2', '2', 'expert', '33', '23', '53', '2004-08-23', '2005-08-23', 'true', 'false', '8');
        ");

        //courses
//        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizzes') VALUES
//        ('1', 'Laravel for Beginner', 'Laravel course that explains the basics of back-end concepts', '2', '1', 'beginner', '23', '0', '20', '2004-08-23', '2005-08-23', 'true', '1', 'false', '0');
//        ");
//        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizzes') VALUES
//        ('2', 'Laravel for Intermediate', 'Laravel course that explains the intermediate concepts of back-end', '2', '1', 'intermediate', '19', '0', '10', '2004-08-23', '2005-08-23', 'true', '1', 'false', '2');
//        ");
//        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizzes') VALUES
//        ('3', 'Laravel for advanced', 'Laravel course that explains advanced concepts of back-end', '2', '1', 'advanced', '40', '0', '34', '2004-08-23', '2005-08-23', 'true', '1', 'false', '5');
//        ");
//        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'topic_id', 'teacher_id', 'difficulty_level', 'num_of_hours', 'price', 'num_of_episodes', 'publishing_request_date', 'publishing_date', 'published', 'admin_id', 'has_certificate', 'total_quizzes') VALUES
//        ('4', 'Laravel for experts', 'Laravel course that explains experts concepts of back-end', '2', '1', 'expert', '33', '0', '53', '2004-08-23', '2005-08-23', 'true', '1', 'false', '8');
//        ");

        //episodes for course 1
//        DB::insert("INSERT INTO 'episodes' ('id', 'course_id', 'title', 'video_url', 'published') VALUES
//        ('1', '1', 'Ep 01 - Hello, Laravel', 'https://youtu.be/1NjOWtQ7S2o?si=hvMiLuAF7eBDTosJ', 'false');
//        ");
//
//        DB::insert("INSERT INTO 'episodes' ('id', 'course_id', 'title', 'video_url', 'published') VALUES
//        ('2', '1', 'Ep 02 - Your First Route and View', 'https://youtu.be/KHxGAOv2Emc?si=9xcl9gHgt2nEI76J', 'false');
//        ");
//
//        DB::insert("INSERT INTO 'episodes' ('id', 'course_id', 'title', 'video_url', 'published') VALUES
//        ('3', '1', 'Ep 03 - Create a Layout File Using Blade Components', 'https://youtu.be/H5R3vV38QiM?si=9UXDpmGJtwXczTcN', 'false');
//        ");
//
//        DB::insert("INSERT INTO 'episodes' ('id', 'course_id', 'title', 'video_url', 'published') VALUES
//        ('4', '1', '30 Days to Learn Laravel, Ep 04 - Make a Pretty Layout Using Tailwind CSS', 'https://youtu.be/37QPJZ1la2g?si=GF5o9Kas2rElYRSA', 'false');
//        ");

        $user = User::withTrashed()->find(2);
        foreach(Course::all() as $course)
            $user->followed_courses()->attach($course, ['progress' => 2, 'perc_progress' => 66.6, 'num_of_completed_quizzes' => 1, 'rate' => 3]);

        // $duration = FFMpeg::fromDisk('public')->open('build/assets/videos/test.mp4')->getDurationInSeconds();

        // episode 1
        Episode::create([
            'course_id' => 1,
            'title' => 'Basics of Laravel and MVC',
            'video_url' => 'https://www.youtube.com/embed/VIDEO_ID',
            'duration' => 30,
            'image_url' => 'episode1.png',
            'admin_id' => 1,
            'published' => true,
            'publishing_date' => '2025-05-23 11:39:24'
        ]);

        // episode 2
        Episode::create([
            'course_id' => 1,
            'title' => 'Routes and Controllers',
            'video_url' => 'https://www.youtube.com/embed/VIDEO_ID',
            'duration' => 45,
            'image_url' => 'episode2.png',
            'admin_id' => 1,
            'published' => false,
            'deleted_at' => '2025-05-23 11:39:24'
        ]);

        // episode 3
        Episode::create([
            'course_id' => 1,
            'title' => 'Blade Engine',
            'video_url' => 'https://www.youtube.com/embed/VIDEO_ID',
            'duration' => 43,
            'image_url' => 'episode3.png',
            'admin_id' => 1,
            'published' => false
        ]);

        // comment 1
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 2
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // reply 1
        Reply::create([
            'comment_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first reply, hello world',
            'likes' => 5
        ]);

        // reply 2
        Reply::create([
            'comment_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second reply, hello world',
            'likes' => 84
        ]);

        // quiz 1
        $quiz = Quiz:: create([
            'episode_id' => 1,
            'num_of_questions' => 3,
        ]);

        // quiz 2
        Quiz::create([
            'episode_id' => 2,
            'num_of_questions' => 2,
        ]);

        // quiz 3
        Quiz::create([
            'episode_id' => 3,
            'num_of_questions' => 2,
        ]);


        // questions in quiz 1
        Question::create([
            'quiz_id' => 1,
            'question_number' => 1,
            'content' => 'what is your name?',
            'answer_a' => 'Omar',
            'answer_b' => 'Hamza',
            'answer_c' => 'Ahmad',
            'answer_d' => 'Ali',
            'right_answer' => 'a'
        ]);

        Question::create([
            'quiz_id' => 1,
            'question_number' => 2,
            'content' => 'what is your name?',
            'answer_a' => 'Omar',
            'answer_b' => 'Hamza',
            'answer_c' => 'Ahmad',
            'answer_d' => 'Ali',
            'right_answer' => 'a'
        ]);

        Question::create([
            'quiz_id' => 1,
            'question_number' => 3,
            'content' => 'what is your name?',
            'answer_a' => 'Omar',
            'answer_b' => 'Hamza',
            'answer_c' => 'Ahmad',
            'answer_d' => 'Ali',
            'right_answer' => 'a'
        ]);

        Question::create([
            'quiz_id' => 2,
            'question_number' => 1,
            'content' => 'what is your name?',
            'answer_a' => 'Omar',
            'answer_b' => 'Hamza',
            'answer_c' => 'Ahmad',
            'answer_d' => 'Ali',
            'right_answer' => 'a'
        ]);

        Question::create([
            'quiz_id' => 2,
            'question_number' => 2,
            'content' => 'what is your name?',
            'answer_a' => 'Omar',
            'answer_b' => 'Hamza',
            'answer_c' => 'Ahmad',
            'answer_d' => 'Ali',
            'right_answer' => 'a'
        ]);

        Question::create([
            'quiz_id' => 3,
            'question_number' => 1,
            'content' => 'what is your name?',
            'answer_a' => 'Omar',
            'answer_b' => 'Hamza',
            'answer_c' => 'Ahmad',
            'answer_d' => 'Ali',
            'right_answer' => 'a'
        ]);

        Question::create([
            'quiz_id' => 3,
            'question_number' => 2,
            'content' => 'what is your name?',
            'answer_a' => 'Omar',
            'answer_b' => 'Hamza',
            'answer_c' => 'Ahmad',
            'answer_d' => 'Ali',
            'right_answer' => 'a'
        ]);

        $user->quizzes()->attach($quiz, ['success' => false, 'mark' => 33]);
        $user->quizzes()->attach($quiz, ['success' => true, 'mark' => 66]);
    }
}
