@extends('layouts.header')

@section('title', 'Episode Quiz')

@section('content')
    <div class="quiz-container">
        <div class="quiz-header">
            <h1 class="quiz-title"><span class="quiz-title-main">QUIZ</span><br> {{ $episode->title }}</h1>
            <div class="quiz-progress">
                Test your knowledge - {{ count($quiz->questions) }} questions
            </div>
        </div>

        <div class="quiz-questions">
            @foreach($quiz->questions as $question)
                <div class="quiz-question">
                    <div class="question-number">Question {{ $loop->iteration }}</div>
                    <div class="question-text">{{ $question->content }}</div>
                    
                    <div class="answer-options">
                        <div @class(['answer-option', 'correct-answer' => $question->right_answer == 'a'])>
                            <span class="answer-letter">A</span>
                            <div class="answer-text">{{ $question->answer_a }}</div>
                            @if($question->right_answer == 'a')
                                <span class="correct-indicator"><i class="fas fa-check"></i> Correct Answer</span>
                            @endif
                        </div>
                        
                        <div @class(['answer-option', 'correct-answer' => $question->right_answer == 'b'])>
                            <span class="answer-letter">B</span>
                            <div class="answer-text">{{ $question->answer_b }}</div>
                            @if($question->right_answer == 'b')
                                <span class="correct-indicator"><i class="fas fa-check"></i> Correct Answer</span>
                            @endif
                        </div>
                        
                        <div @class(['answer-option', 'correct-answer' => $question->right_answer == 'c'])>
                            <span class="answer-letter">C</span>
                            <div class="answer-text">{{ $question->answer_c }}</div>
                            @if($question->right_answer == 'c')
                                <span class="correct-indicator"><i class="fas fa-check"></i> Correct Answer</span>
                            @endif
                        </div>
                        
                        <div @class(['answer-option', 'correct-answer' => $question->right_answer == 'd'])>
                            <span class="answer-letter">D</span>
                            <div class="answer-text">{{ $question->answer_d }}</div>
                            @if($question->right_answer == 'd')
                                <span class="correct-indicator"><i class="fas fa-check"></i> Correct Answer</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@include('layouts.footer')
@endsection