@extends('layouts.header')

@section('title', $course->title)

@section('content')
<div class="course-details-container">
    <div class="course-details-header">
        <div class="course-details-image">
            <img src="{{ asset('build/assets/img/courses/' . $course->image_url) }}" alt="{{ $course->title }}">
        </div>
        
        <div class="course-details-info">
            <div class="course-details-title-container">
                <h1 class="course-details-title">{{ $course->title }}</h1>
                <div class="course-status-badge @if($course->published) published @else unpublished @endif">
                    @if($course->published)
                        <i class="fas fa-check-circle"></i> Published
                    @else
                        <i class="fas fa-clock"></i> Unpublished
                    @endif
                </div>
            </div>
            
            <div class="course-details-meta">
                <div class="course-meta-item">
                    <span class="course-meta-label">Teacher:</span>
                    <span class="course-meta-value">{{ $course->teacher->first_name }} {{ $course->teacher->last_name }}</span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-label">Category:</span>
                    <span class="course-meta-value">{{ $course->topic->category->title }} / {{ $course->topic->title }}</span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-label">Difficulty:</span>
                    <span class="course-meta-value">{{ $course->difficulty_level }}</span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-label">Duration:</span>
                    <span class="course-meta-value">{{ $course->num_of_hours }} hours</span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-label">Price:</span>
                    <span class="course-meta-value">
                        @if($course->price == 0)
                            FREE
                        @else
                            ${{ number_format($course->price, 2) }}
                        @endif
                    </span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-label">Certificate:</span>
                    <span class="course-meta-value">
                        @if($course->has_certificate)
                            <i class="fas fa-certificate text-success"></i> Available
                        @else
                            <i class="fas fa-times-circle text-muted"></i> Not Available
                        @endif
                    </span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-label">Quizzes:</span>
                    <span class="course-meta-value">{{ $course->episodes_count }}</span>
                </div>
                <div class="course-meta-item">
                    <span class="course-meta-label">
                        @if($course->published)
                            Published Date:
                        @else
                            Request Date:
                        @endif
                    </span>
                    <span class="course-meta-value">
                        @if($course->published)
                            {{ \Carbon\Carbon::parse($course->publishing_date)->format('M d, Y') }}
                        @else
                            {{ \Carbon\Carbon::parse($course->publishing_request_date)->format('M d, Y') }}
                        @endif
                    </span>
                </div>
                <div class="course-meta-item">
                    <span class="meta-label">Rate:</span>
                    <span>
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $course->rate)
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
    
    <div class="course-details-description">
        <h2 class="course-section-title">Description</h2>
        <div class="course-description-content">
            {{ $course->description }}
        </div>
    </div>
    
    @if($course->episodes->count() > 0)
        <div class="course-episodes-section">
            <h2 class="course-section-title">Episodes ({{ $course->episodes->count() }})</h2>
            
            <div class="course-episodes-list">
                @foreach($course->episodes as $episode)
                <div class="course-episode-item {{ !$episode->published ? 'episode-pending' : '' }}">
                    <div class="episode-number">{{ $loop->iteration }}</div>
                    <div class="episode-info">
                        <h3 class="episode-title">
                            {{ $episode->title }}
                        </h3>
                        <div class="episode-meta">
                            <span class="episode-duration"><i class="fas fa-clock"></i> {{ $episode->duration }} min</span>
                            @if($episode->has_quiz)
                                <span class="episode-quiz"><i class="fas fa-question-circle"></i> Has Quiz</span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('courses.video', ['episode_id' => $episode->id]) }}" class="episode-view-btn">
                        @if($episode->published)
                            <i class="fas fa-play"></i> View
                        @else
                            <i class="fas fa-spinner"></i> Pending
                        @endif
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@include('layouts.footer')
@endsection