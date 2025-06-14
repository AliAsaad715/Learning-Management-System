@extends('layouts.header')

@use('Carbon\Carbon')

@section('title', 'Followed Course')

@section('content')

<div class="course-details-container">
        <!-- Course Header Section -->
        <section class="course-header">
            <div class="course-hero">
                <img src="{{ asset("build/assets/img/courses/$course->image_url") }}" alt="Course image" class="course-hero-image">
                <div class="course-basic-info">
                    <h1 class="course-title">{{ $course->title }}</h1>
                    <p class="course-description">{{ $course->description }}</p>
                    
                    <div class="course-meta-grid">
                        <div class="course-meta-item">
                            <span class="meta-label">Topic:</span>
                            <span class="meta-value">{{ $course->topic->title }}</span>
                        </div>
                        <div class="course-meta-item">
                            <span class="meta-label">Teacher:</span>
                            <span class="meta-value">{{ $course->teacher->first_name }} {{ $course->teacher->last_name }}</span>
                        </div>
                        <div class="course-meta-item">
                            <span class="meta-label">Difficulty:</span>
                            <span class="meta-value">{{ $course->difficulty_level }}</span>
                        </div>
                        <div class="course-meta-item">
                            <span class="meta-label">Duration:</span>
                            <span class="meta-value">{{ $course->num_of_hours }} hours</span>
                        </div>
                        <div class="course-meta-item">
                            <span class="meta-label">Episodes:</span>
                            <span class="meta-value">{{ $course->num_of_episodes }}</span>
                        </div>
                        <div class="course-meta-item">
                            <span class="meta-label">Published:</span>
                            <span class="meta-value">{{ Carbon::parse($course->publishing_date)->format('M d, Y') }}</span>
                        </div>
                        <div class="course-meta-item">
                            <span class="meta-label">Price:</span>
                            <span class="meta-value">
                                @if($course->price == 0)
                                    FREE
                                @else
                                    ${{ number_format($course->price, 2) }}
                                @endif
                            </span>
                        </div>
                        <div class="course-meta-item">
                            <span class="meta-label">User Feedback:</span>
                            <span>
                                 @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating)
                                        <i class="fas fa-star full-star"></i>
                                    @else
                                        <i class="far fa-star empty-star"></i>
                                    @endif
                                @endfor
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- User Progress Section -->
        <section class="user-progress-section">
            <h2 class="section-title">User Progress</h2>
            <div class="progress-container">
                <div class="progress-overview">
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: {{ $course->pivot->perc_progress }}%"></div>
                    </div>
                    <span class="progress-percentage">{{ $course->pivot->perc_progress }}% Complete</span>
                </div>
                
                <div class="progress-details">
                    <div class="progress-stat">
                        <span class="stat-value">{{ $course->pivot->progress }}</span>
                        <span class="stat-label">Episodes Completed</span>
                    </div>
                    <div class="progress-stat">
                        <span class="stat-value">{{ $course->pivot->num_of_completed_quizzes }}</span>
                        <span class="stat-label">Quizzes Passed</span>
                    </div>
                    <div class="progress-stat">
                        <span class="stat-value">{{ $total_quizzes }}</span>
                        <span class="stat-label">Total Quizzes</span>
                    </div>
                </div>
            </div>
            
            @if($course->pivot->num_of_completed_quizes == $total_quizzes)
                <div class="certificate-badge">
                    <i class="fas fa-certificate"></i>
                    <span>Certificate Earned</span>
                </div>
            @else
                <div class="certificate-pending">
                    <i class="fas fa-hourglass-half"></i>
                    <span>User hasn't complete all quizzes yet to earn certificate</span>
                </div>
            @endif
        </section>

        <!-- Quizzes Section -->
        <section class="quizzes-section">
            <h2 class="section-title">Quizzes</h2>
            
            @if(count($quizzes) > 0)
                <div class="quizzes-list">
                    @foreach($quizzes as $quiz)
                        <div class="quiz-card {{ $quiz->success ? 'quiz-passed' : 'quiz-pending' }}">
                            <div class="quiz-info">
                                <h3 class="quiz-title">{{ $quiz->episode->title }}</h3>
                                <p class="quiz-episode">Episode {{ $quiz->episode_id }}</p>
                            </div>
                            <div class="quiz-status">
                                @if($quiz->success)
                                    <span class="quiz-score"><i class="fas fa-check-circle"></i> Passed ({{ $quiz->mark }}%)</span>
                                @else
                                    <span class="quiz-score"><i class="fas fa-exclamation-circle"></i> Failed</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-question-circle"></i>
                    <p>No quizzes available for this course</p>
                </div>
            @endif
        </section>
    </div>
@include('layouts.footer')
@endsection