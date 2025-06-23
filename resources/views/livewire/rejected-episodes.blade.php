@use('Carbon\Carbon')

<div class="episode-reject-container">
    <h1 class="episode-reject-page-title">Rejected Episodes</h1>
    
    <div class="episode-reject-list">
        @foreach($rejected_episodes as $episode)
        <div class="episode-reject-row">
            <div class="episode-reject-image">
                <img src="{{ asset('build/assets/img/episodes/' . $episode->image_url) }}" alt="{{ $episode->title }}">
            </div>
            
            
            <div class="episode-reject-details">
                <h2 class="episode-reject-title">{{ $episode->title }}</h2>
                <p class="episode-reject-course">
                    From course: 
                    @if($episode->course->published)
                        <a href="{{ route('courses.show_course', ['course' => $episode->course->id]) }}" class="episode-reject-course-link">
                            {{ $episode->course->title }}
                        </a>
                    @else
                        <span class="episode-reject-course-rejected">{{ $episode->course->title }} (Rejected)</span>
                    @endif
                </p>
                
                <div class="episode-reject-meta">
                    <div class="episode-reject-meta-item">
                        <span class="episode-reject-meta-label">Teacher:</span>
                        <span class="episode-reject-meta-value">{{ $episode->course->teacher->first_name }} {{$episode->course->teacher->last_name}}</span>
                    </div>
                    <div class="episode-reject-meta-item">
                        <span class="episode-reject-meta-label">Duration:</span>
                        <span class="episode-reject-meta-value">{{ $episode->duration }} mins</span>
                    </div>
                    <div class="episode-reject-meta-item">
                        <span class="episode-reject-meta-label">Request Date:</span>
                        <span class="episode-reject-meta-value">{{ Carbon::parse($episode->publishing_request_date)->format('M d, Y') }}</span>
                    </div>
                    <div class="episode-reject-meta-item">
                        <span class="episode-reject-meta-label">Rejected By:</span>
                        <span class="episode-reject-meta-value">{{ $episode->admin->first_name}} {{$episode->admin->last_name}}</span>
                    </div>
                </div>
            </div>
            
            <div class="episode-reject-actions">
                <a href="{{route('courses.video', ['episode_id' => $episode->id])}}" class="episode-reject-action-btn episode-reject-appeal-btn">More Detais</a>
                <button wire:click="republish({{$episode->id}})" type="button" class="episode-reject-action-btn episode-reject-restore-btn">Republish</button>
            </div>
        </div>
        @endforeach
        
        @if($rejected_episodes->isEmpty())
            <div class="episode-reject-empty-state">
                <i class="fas fa-ban"></i>
                <p>No rejected episodes found</p>
            </div>
        @endif
    </div>
</div>
