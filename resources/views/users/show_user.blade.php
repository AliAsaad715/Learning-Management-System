@extends('layouts.header')

@section('title', 'User Detailed Profile')

@section('content')
    <div class="user-profile-container">
        <header class="user-profile-header">
            <img src="{{$user->profile_image_url ? asset("build/assets/img/profiles/$user->profile_image_url") : asset('build/assets/img/anonymous_icon.png')}}" alt="User Avatar" class="user-profile-avatar">
            <div class="user-profile-userinfo">
                <h1>{{$user->first_name}} {{$user->last_name}}</h1>
                <p class="user-profile-tagline">{{$user->moreDetail->jobTitle->title}} | {{$user->moreDetail->country->name}}</p>
                
                <div class="user-profile-stats">
                    <div class="user-profile-stat">
                        <div class="user-profile-stat-value">{{$counts['followed_courses_count']}}</div>
                        <div class="user-profile-stat-label">Followed Courses</div>
                    </div>
                    <div class="user-profile-stat">
                        <div class="user-profile-stat-value">{{$counts['activities_count']}}</div>
                        <div class="user-profile-stat-label">Activity</div>
                    </div>
                    <div class="user-profile-stat">
                        <div class="user-profile-stat-value">{{$counts['badges_count']}}</div>
                        <div class="user-profile-stat-label">Badges</div>
                    </div>
                    <div class="user-profile-stat">
                        <div class="user-profile-stat-value">{{$user->role}}</div>
                        <div class="user-profile-stat-label">Role</div>
                    </div>
                </div>
            </div>
        </header>

        <main class="user-profile-sections">
            <!-- Personal Information Section -->
            <section class="user-profile-section">
                <h2 class="user-profile-section-title">Personal Information</h2>
                
                <div class="user-profile-info-grid">
                    <div class="user-profile-info-item">
                        <span class="user-profile-info-label">Email:</span>
                        <span class="user-profile-info-value">{{$user->email}}</span>
                    </div>
                    <div class="user-profile-info-item">
                        <span class="user-profile-info-label">Role:</span>
                        <span class="user-profile-info-value">{{$user->role}}</span>
                    </div>
                    <div class="user-profile-info-item">
                        <span class="user-profile-info-label">Mother Tongue:</span>
                        <span class="user-profile-info-value">{{$mother_tongue->name}}</span>
                    </div>
                    <div class="user-profile-info-item">
                        <span class="user-profile-info-label">Join Date:</span>
                        <span class="user-profile-info-value">{{\Carbon\Carbon::parse($user->join_date)->format('M d, Y')}}</span>
                    </div>
                </div>
                <div class="user-profile-languages-section">
                    <h3 class="user-profile-subsection-title">Languages</h3>
                    @if(!$user->moreDetail->languages->isEmpty())
                        <div class="user-profile-languages">
                            @foreach ($user->moreDetail->languages as $language)
                            @if($language->level != 'mother_tongue')
                            <div class="user-profile-language">
                                <span class="user-profile-language-name">{{$language->name}}</span>
                                <span class="user-profile-language-level">({{$language->pivot->level}})</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    @else
                        <div class="user-profile-empty">
                            <div class="user-profile-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            </div>
                            <h3 class="user-profile-empty-title">No Data Available</h3>
                            <p class="user-profile-empty-text">This section is currently empty.</p>
                        </div>
                    @endif
                </div>
            </section>
    
            <!-- Professional Information Section -->
            <section class="user-profile-section">
                <h2 class="user-profile-section-title">Professional Details</h2>
                
                <div class="user-profile-info-grid">
                    <div class="user-profile-info-item">
                        <span class="user-profile-info-label">Job Title:</span>
                        <span class="user-profile-info-value">{{$user->moreDetail->jobTitle->title}}</span>
                    </div>
                    <div class="user-profile-info-item">
                        <span class="user-profile-info-label">Country:</span>
                        <span class="user-profile-info-value">{{$user->moreDetail->country->name}}</span>
                    </div>
                    <div class="user-profile-info-item">
                        <span class="user-profile-info-label">LinkedIn:</span>
                        @if($user->moreDetail->linkedin_url)
                            <span class="user-profile-info-value">{{$user->moreDetail->linkedin_url}}</span>
                        @else
                            <span class="user-profile-info-value">N/A</span>
                        @endif
                    </div>
                    <div class="user-profile-info-item">
                        <span class="user-profile-info-label">Education:</span>
                        @if($user->moreDetail->education)
                            <span class="user-profile-info-value">{{$user->moreDetail->education}}</span>
                        @else
                            <span class="user-profile-info-value">None listed</span>
                        @endif
                    </div>
                </div>
    
                <div class="user-profile-skills-section">
                    <h3 class="user-profile-subsection-title">Skills</h3>
                    @if(!$user->moreDetail->skills->isEmpty())
                        <div class="user-profile-skills">
                            @foreach($user->moreDetail->skills as $skill)
                                <span class="user-profile-skill">{{$skill->title}}</span>
                            @endforeach
                        </div>
                    @else
                        <div class="user-profile-empty">
                            <div class="user-profile-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            </div>
                            <h3 class="user-profile-empty-title">No Data Available</h3>
                            <p class="user-profile-empty-text">This section is currently empty.</p>
                        </div>
                    @endif
                </div>
            </section>

            
            <!-- Activity Section -->
            <section class="user-profile-section activities-section">
                <h2 class="user-profile-section-title">Recent Activity</h2>
                <div class="section-scroll">
                    @if(!$user->comments->isEmpty() || !$user->replies->isEmpty())
                        @if(!$user->comments->isEmpty())
                            @foreach($user->comments as $comment)
                                <div class="user-profile-comment">
                                    <div class="user-profile-comment-content">
                                        <p>{{$comment->content}}</p>
                                    </div>
                                    <div class="user-profile-comment-meta">
                                        <span><span class="meta">Posted in:</span> {{$comment->episode->course->title}}</span>
                                        <span><span class="meta">Episode:</span> {{$comment->episode->title}}</span>
                                        <span class="meta" style="min-width: 110px">{{\Carbon\Carbon::parse($comment->comment_date)->format('M d, Y')}}</span>
                                    </div>
                                </div>
                            @endforeach  
                        @endif  
                        @if(!$user->replies->isEmpty())  
                            @foreach($user->replies as $reply)
                                <div class="user-profile-comment">
                                    <div class="user-profile-comment-content">
                                        <p>{{$reply->content}}</p>
                                    </div>
                                    <div class="user-profile-comment-meta">
                                        <span><span class="meta">Posted in:</span> {{$reply->comment->episode->course->title}}</span>
                                        <span><span class="meta">Episode:</span> {{$reply->comment->episode->title}}</span>
                                        <span><span class="meta">Reply on:</span> {{$reply->comment->content}}</span>
                                        <span class="meta" style="min-width: 110px">{{\Carbon\Carbon::parse($reply->reply_date)->format('M d, Y')}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @else
                        <div class="user-profile-empty">
                            <div class="user-profile-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            </div>
                            <h3 class="user-profile-empty-title">No Data Available</h3>
                            <p class="user-profile-empty-text">This section is currently empty.</p>
                        </div>
                    @endif
                </div>
            </section>
            
            
            <!-- Badges Section -->
            <section class="user-profile-section">
                <h2 class="user-profile-section-title">Earned Badges</h2>
                @if(!$user->badges->isEmpty())
                <div class="user-profile-badges">
                        @foreach($user->badges as $badge)
                        <div class="user-profile-badge">
                                <div class="user-profile-badge-icon"><img class="user-profile-badge-image" src="{{asset("build/assets/img/badges/$badge->image_url")}}" alt="{{$badge->imge_url}}"></div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="user-profile-empty">
                        <div class="user-profile-empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        </div>
                        <h3 class="user-profile-empty-title">No Data Available</h3>
                        <p class="user-profile-empty-text">This section is currently empty.</p>
                    </div>
                @endif
            </section>
        
            <!-- Courses Section -->
            <section class="user-profile-section user-profile-followed-courses-section">
                <h2 class="user-profile-section-title">Enrolled Courses</h2>
                <div class="section-scroll">
                    @if(!$user->followed_courses->isEmpty())
                        <div class="user-profile-courses-grid">
                            @foreach($user->followed_courses as $course)
                            <a href="{{route('users.followed_course', ['user_id' => $user->id, 'course_id' => $course->id])}}">
                                <div class="user-profile-course-card">
                                    <img src="{{asset("build/assets/img/courses/$course->image_url")}}" alt="{{$course->title}}" class="user-profile-course-thumbnail">
                                    <div class="user-profile-course-content">
                                        <h3 class="user-profile-course-title">{{$course->title}}</h3>
                                        <div class="user-profile-progress-container">
                                            <div class="user-profile-course-progress">
                                                <div class="user-profile-course-progress-bar" style="width: {{$course->pivot->perc_progress ?? 0}}%"></div>
                                            </div>
                                            <span class="user-profile-progress-percentage">{{$course->pivot->perc_progress ?? 0}}%</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @else
                        <div class="user-profile-empty">
                            <div class="user-profile-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            </div>
                            <h3 class="user-profile-empty-title">No Data Available</h3>
                            <p class="user-profile-empty-text">This section is currently empty.</p>
                        </div>
                    @endif
                </div>
            </section>
                
            <!-- Add this new Statistics section -->
            <section class="user-profile-section user-profile-statistics-section">
                <h2 class="user-profile-section-title">Statistics</h2>
                <div class="user-profile-statistics-grid">
                    @forEach($user->statistics as $statistic)
                        @if($statistic->title != 'Acquired Likes' && $statistic->title != 'Acquired Views' && $statistic->title != 'Published Courses')
                            <div class="user-profile-statistic-item">
                                <div class="user-profile-statistic-title">{{$statistic->title}}</div>
                                <div class="user-profile-statistic-value">{{$statistic->pivot->progress}}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section> 
        </main>

        <!-- Action Buttons -->
         <div class="user-profile-actions-container">
            @if($user->deleted_at != null && $user->moreDetail->is_banned)
                <div>
                    <a href="{{route('users.unban', ['user_id' => $user->id])}}" class="ban-button cancel"><div>UNBAN</div><img src="{{asset('build/assets/img/active_icon.png')}}" alt="ban icon"></a    >
                </div>
            @elseif($user->deleted_at != null)
                <p class="deleted-word">Deleted</p>
            @else
                <form action="{{route('users.ban', ['user' => $user->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="ban-button"><div class="ban-word">BAN</div><img src="{{asset('build/assets/img/ban_icon.png')}}" alt="ban icon"></button>
                </form>
            @endif
        </div>
    </div>
@include('layouts.footer')
@endsection