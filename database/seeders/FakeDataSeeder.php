<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Episode;
use App\Models\MoreDetail;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'admin_id', 'difficulty_level', 'total_of_time', 'price', 'rate', 'language_id', 'num_of_episodes', 'num_of_students_enrolled', 'publishing_request_date', 'publishing_date', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('1', 'Laravel for Beginner', 'Laravel course that explains the basics of back-end concepts', 'course1.png', '2', '2', '1', 'beginner', '23', '0', '4', '1', '20', '1', '2004-08-23', '2005-08-23', 'approved', 'true', '0');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'admin_id', 'difficulty_level', 'total_of_time', 'price', 'rate', 'language_id', 'num_of_episodes', 'num_of_students_enrolled', 'publishing_request_date', 'deleted_at', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('2', 'Laravel for Intermediate', 'Laravel course that explains the intermediate concepts of back-end', 'course2.png', '2', '2', '1', 'intermediate', '19', '10', '3', '1', '10', '0', '2004-08-23', '2005-08-23', 'rejected', 'false', '2');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'admin_id', 'difficulty_level', 'total_of_time', 'price', 'rate', 'language_id', 'num_of_episodes', 'num_of_students_enrolled', 'publishing_request_date', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('3', 'Laravel for advanced', 'Laravel course that explains advanced concepts of back-end', 'course3.png', '2', '2', '1', 'advanced', '40', '32', '2', '1', '34', '1', '2004-08-23', 'rejected', 'false', '5');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'admin_id', 'difficulty_level', 'total_of_time', 'price', 'language_id', 'num_of_episodes' ,'num_of_students_enrolled', 'publishing_request_date', 'publishing_date', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('4', 'Laravel for experts', 'Laravel course that explains experts concepts of back-end', 'course4.png', '2', '2', '1', 'expert', '33', '23', '1', '53', '4', '2004-08-23', '2005-08-23', 'approved', 'false', '8');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'admin_id', 'difficulty_level', 'total_of_time', 'price', 'language_id', 'num_of_episodes', 'num_of_students_enrolled', 'publishing_request_date', 'publishing_date', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('5', 'Laravel for Beginner', 'Laravel course that explains the basics of back-end concepts', 'course1.png', '2', '2', '1', 'beginner', '33', '23', '6', '53', '2', '2004-08-23', '2005-08-23', 'approved', 'false', '8');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'admin_id', 'difficulty_level', 'total_of_time', 'price', 'rate', 'language_id', 'num_of_episodes', 'num_of_students_enrolled', 'publishing_request_date', 'publishing_date', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('6', 'Laravel for Intermediate', 'Laravel course that explains the intermediate concepts of back-end', 'course2.png', '2', '2', '1', 'intermediate', '19', '10', '3', '6', '10', '0', '2004-08-23', '2005-08-23', 'approved', 'false', '2');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'admin_id', 'difficulty_level', 'total_of_time', 'price', 'rate', 'language_id', 'num_of_episodes', 'num_of_students_enrolled', 'publishing_request_date', 'publishing_date', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('7', 'Laravel for advanced', 'Laravel course that explains advanced concepts of back-end', 'course3.png', '2', '2', '1', 'advanced', '40', '32', '2', '6', '34', '1', '2004-08-23', '2004-08-23', 'approved', 'false', '5');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'admin_id', 'difficulty_level', 'total_of_time', 'price', 'rate', 'language_id', 'num_of_episodes', 'num_of_students_enrolled', 'publishing_request_date', 'publishing_date', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('8', 'Laravel for advanced', 'Laravel course that explains advanced concepts of back-end', 'course3.png', '2', '2', '1', 'advanced', '40', '32', '2', '3', '34', '2', '2004-08-23', '2004-08-23', 'approved', 'false', '5');
        ");
        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'admin_id', 'difficulty_level', 'total_of_time', 'price', 'rate', 'language_id', 'num_of_episodes', 'num_of_students_enrolled', 'publishing_request_date', 'publishing_date', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('9', 'Laravel Projects', 'Laravel course implements projects', 'course3.png', '2', '2', '1', 'advanced', '40', '32', '2', '1', '3', '34', '2004-08-23', '2004-08-23', 'approved', 'true', '5');
        ");

        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'difficulty_level', 'total_of_time', 'price', 'rate', 'language_id', 'num_of_episodes', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('10', 'Laravel for Beginner', 'Laravel course that explains the basics of back-end concepts', 'course1.png', '2', '2', 'beginner', '23', '77', '4', '1', '0', 'draft', 'true', '0');
        ");

        DB::insert("INSERT INTO 'courses' ('id', 'title', 'description', 'image_url', 'topic_id', 'teacher_id', 'difficulty_level', 'total_of_time', 'price', 'rate', 'language_id', 'num_of_episodes', 'num_of_students_enrolled', 'publishing_request_date', 'status', 'has_certificate', 'total_quizzes') VALUES
        ('11', 'Laravel for Intermediate', 'Laravel course that explains the intermediate concepts of back-end', 'course2.png', '2', '2', 'intermediate', '19', '10', '3', '1', '10', '0', '2025-06-30', 'pending', 'true', '2');
        ");

        $user = User::withTrashed()->find(2);
        foreach(Course::all() as $course)
            $user->followed_courses()->attach($course, ['progress' => 2, 'perc_progress' => 66.6, 'num_of_completed_quizzes' => 1, 'rate' => 3]);

        // episode 1
        Episode::create([
            'course_id' => 1,
            'title' => 'Basics of Laravel and MVC',
            'episode_number' => 1,
            'video_url' => 'videos/video.mp4',
            'duration' => 151,
            'image_url' => 'episode1.png',
        ]);

        // episode 2
        Episode::create([
            'course_id' => 1,
            'title' => 'Routes and Controllers',
            'episode_number' => 2,
            'video_url' => 'videos/video.mp4',
            'duration' => 151,
            'image_url' => 'episode2.png',
        ]);

        // episode 3
        Episode::create([
            'course_id' => 1,
            'title' => 'Blade Engine',
            'episode_number' => 3,
            'video_url' => 'videos/video.mp4',
            'duration' => 43,
            'image_url' => 'episode3.png',
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

        // comment 3
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 4
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 5
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 6
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 7
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 8
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 9
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 10
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 11
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 12
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 13
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 14
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 15
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 16
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 17
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 18
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 19
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 20
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 21
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 22
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 23
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 24
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 25
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 26
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 27
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 28
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 29
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 30
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 31
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 32
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 33
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the first comment, hello world',
            'likes' => 203,
        ]);

        // comment 34
        Comment::create([
            'episode_id' => 1,
            'user_id' => 2,
            'content' => 'this is the second comment, hello world',
            'likes' => 83,
        ]);

        // comment 35
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
        $quiz1 = Quiz:: create([
            'episode_id' => 1,
            'num_of_questions' => 3,
        ]);

        // quiz 2
        $quiz2 = Quiz::create([
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
        $user->quizzes()->attach($quiz1, ['success' => false, 'mark' => 1, 'percentage_mark' => 33]);
        $user->quizzes()->attach($quiz2, ['success' => true, 'mark' => 2, 'percentage_mark' => 100]);
    }
}
