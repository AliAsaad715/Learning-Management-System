@props(['pendingEpisodes'])

@use('Carbon\Carbon')

<div class="tab-content">
    <h1 class="pending-episodes-title">Pending Episodes <span class="pending-count-badge">{{ count($pendingEpisodes) }}</span></h1>
    
    <div class="pending-episodes-list">
        @foreach($pendingEpisodes as $episode)
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
                        <span class="pending-meta-value">{{ Carbon::parse($episode->publishing_request_date)->format('M d, Y') }}</span>
                    </div>
                </div>
                
                <div class="pending-episode-actions">
                    <a href="{{ route('courses.video', ['episode_id' => $episode->id]) }}" class="pending-action-btn pending-details-btn">
                        <i class="fas fa-eye"></i> View Details
                    </a>
                        <button wire:click="approve({{$episode->id}})" type="button" class="pending-action-btn pending-approve-btn">
                            <i class="fas fa-check"></i> Approve
                        </button>
                        <button wire:click="reject({{$episode->id}})" type="button" class="pending-action-btn pending-reject-btn">
                            <i class="fas fa-times"></i> Reject
                        </button>
                </div>
            </div>
        </div>
        @endforeach
        
        @if($pendingEpisodes->isEmpty())
        <div class="pending-empty-state">
            <i class="fas fa-check-circle"></i>
            <p>No pending episodes to review</p>
        </div>
        @endif
    </div>
</div>