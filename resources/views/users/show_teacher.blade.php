@extends('layouts.header')

@section('title', 'Teacher Detailed Profile')

@section('content')
     <div class="user-profile-container">
        <header class="user-profile-header">
            <img src="{{$user->profile_image_url ? asset("build/assets/img/profiles/$user->profile_image_url") : asset('build/assets/img/anonymous_icon.png')}}" alt="User Avatar" class="user-profile-avatar">
            <div class="user-profile-userinfo">
                <h1>{{$user->first_name}} {{$user->last_name}}</h1>
                <p class="user-profile-tagline">{{$user->moreDetail->jobTitle->title}} | {{$user->moreDetail->country->name}}</p>
                
                <div class="user-profile-stats">
                    <div class="user-profile-stat">
                        <div class="user-profile-stat-value">{{$counts['published_courses']}}</div>
                        <div class="user-profile-stat-label">Published Courses</div>
                    </div>
                    <div class="user-profile-stat">
                        <div class="user-profile-stat-value">{{$counts['acquired_views']}}</div>
                        <div class="user-profile-stat-label">Acquired Views</div>
                    </div>
                    <div class="user-profile-stat">
                        <div class="user-profile-stat-value">{{$counts['acquired_likes']}}</div>
                        <div class="user-profile-stat-label">Acquired Likes</div>
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
            
            <!-- Published Courses (teacher-specific section) -->
            <section class="user-profile-section  user-profile-published_courses-section">
                <h2 class="user-profile-section-title">Published Courses</h2>
                @if(!$user->published_courses->isEmpty())
                    <div class="courses-grid">
                        @foreach ($user->published_courses as $course)
                            <a href="{{route('courses.show_course', ['course' => $course->id])}}">
                                <div class="course-card">
                                    <div class="course-image">
                                        <img src="{{asset("build/assets/img/courses/$course->image_url")}}" alt="Course Image">
                                    </div>
                                    <div class="course-details">
                                        <h3 class="course-title">{{$course->title}}</h3>
                                        <span class="course-teacher">By  <span class="teacher-name">{{$course->teacher->first_name}} {{$course->teacher->last_name}}</span></span>
                                        <div class="course-meta">
                                            <span class="meta-item"><i class="fas fa-clock"></i> {{$course->num_of_hours}}h</span>
                                            <span class="meta-item"><i class="fas fa-video"></i> {{$course->num_of_episodes}} Episodes</span>
                                            <span class="meta-item"><i class="fas fa-signal"></i> {{$course->difficulty_level}}</span>
                                            <div class="course-date">
                                                <i class="fas fa-calendar-alt"></i> Published at : <span class="date">{{\Carbon\Carbon::parse($course->publishing_date)->format('M d, Y')}}</span>
                                            </div>    
                                        </div>
                                        <div class="price">
                                            @if($course->price == 0)
                                            <span><i class="fas fa-dollar-sign"></i> FREE</span>
                                            @else
                                            <span><i class="fas fa-dollar-sign"></i></i> {{$course->price}}</span>
                                            @endif
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