@extends('layouts.header')

@section('title', 'Course Management')

@section('content')
<div class="courses-container">
    <h1 class="courses-title">Course Management</h1>
    
    <div class="courses-tabs">
        <!-- Radio inputs for tab control -->
        <input type="radio" name="course-tabs" id="active-tab" checked hidden>
        <input type="radio" name="course-tabs" id="rejected-tab" hidden>
        <input type="radio" name="course-tabs" id="pending-tab" hidden>
        
        <!-- Tab Labels -->
        <div class="tab-labels">
            <label for="active-tab" class="tab">Active Courses</label>
            <label for="rejected-tab" class="tab">Rejected Episodes</label>
            <label for="pending-tab" class="tab">Pending Episodes</label>
        </div>

        <!-- Tab Contents -->
        <div class="tab-content-wrapper">
            <!-- Active Courses -->
            <div class="tab-content">
                @foreach($categories as $category)
                <div class="category-card">
                    <h2 class="category-title">{{$category->title}}</h2>
                    <div class="category-container">
                        <div class="topics-container">
                            @foreach($category->topics as $topic)
                                <a href="{{route('courses.active_courses', ['cate' => $category->id, 'topic' => $topic->id])}}" 
                                   class="topic-tag">{{$topic->title}}</a>
                            @endforeach
                        </div>
                        <div class="category-img">
                            <img src="{{ asset('build/assets/img/categories/' . $category->image_url)}}" alt="category image">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Rejected Episodes -->
            <div class="tab-content">
                @foreach($categories as $category)
                <div class="category-card">
                    <h2 class="category-title">{{$category->title}}</h2>
                    <div class="category-container">
                        <div class="topics-container">
                            @foreach($category->topics as $topic)
                                <a href="{{route('courses.rejected_episodes', ['topic' => $topic->id])}}" 
                                   class="topic-tag">{{$topic->title}}</a>
                            @endforeach
                        </div>
                        <div class="category-img">
                            <img src="{{ asset('build/assets/img/categories/' . $category->image_url)}}" alt="category image">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pending Episodes -->
            <div class="tab-content">
                <h1 class="pending-episodes-title">Pending Episodes <span class="pending-count-badge">{{ count($pending_episodes) }}</span></h1>
                
                <div class="pending-episodes-list">
                    @foreach($pending_episodes as $episode)
                    <div class="pending-episode-card">
                        <div class="pending-episode-media">
                            <img src="{{ asset('build/assets/img/episodes/' . $episode->image_url) }}" alt="{{ $episode->title }}" class="pending-episode-thumbnail">
                            <span class="pending-episode-duration">{{ $episode->duration }} min</span>
                        </div>
                        
                        <div class="pending-episode-content">
                            <div class="pending-episode-header">
                                <h2 class="pending-episode-title">{{ $episode->title }}</h2>
                                <div class="pending-episode-course">
                                    From course: 
                                    <a href="{{ route('courses.show_course', ['course' => $episode->course->id]) }}" class="pending-course-link @unless($episode->course->published) course-unpublished @endunless">
                                        {{ $episode->course->title }}
                                        @unless($episode->course->published)
                                            <span class="course-status-badge">(Unpublished)</span>
                                        @endunless
                                    </a>
                                </div>
                            </div>
                            
                            <div class="pending-episode-meta">
                                <div class="pending-meta-item">
                                    <span class="pending-meta-label">Teacher:</span>
                                    <span class="pending-meta-value">{{ $episode->course->teacher->first_name }} {{ $episode->course->teacher->last_name }}</span>
                                </div>
                                <div class="pending-meta-item">
                                    <span class="pending-meta-label">Category:</span>
                                    <span class="pending-meta-value">{{ $episode->course->topic->category->title}}/{{ $episode->course->topic->title }}</span>
                                </div>
                                <div class="pending-meta-item">
                                    <span class="pending-meta-label">Submitted:</span>
                                    <span class="pending-meta-value">{{ \Carbon\Carbon::parse($episode->publishing_request_date)->format('M d, Y') }}</span>
                                </div>
                            </div>
                            
                            <div class="pending-episode-actions">
                                <a href="{{ route('courses.video', ['episode_id' => $episode->id]) }}" class="pending-action-btn pending-details-btn">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                <form action="{{ route('courses.approve', ['episode' => $episode->id]) }}" method="POST" class="pending-action-form">
                                    @csrf
                                    <button type="submit" class="pending-action-btn pending-approve-btn">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <form action="{{ route('courses.reject', ['episode' => $episode->id]) }}" method="POST" class="pending-action-form">
                                    @csrf
                                    <button type="submit" class="pending-action-btn pending-reject-btn">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    @if($pending_episodes->isEmpty())
                    <div class="pending-empty-state">
                        <i class="fas fa-check-circle"></i>
                        <p>No pending episodes to review</p>
                    </div>
                    @endif
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>
@endsection