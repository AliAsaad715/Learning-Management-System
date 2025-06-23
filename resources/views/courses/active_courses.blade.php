@use('Carbon\Carbon')

<x-layouts.header title="Course Management" :with-footer="true">
    <div class="courses-container">
        <h1 class="courses-title">Course Management</h1>

        <!-- Active Courses Section -->
        <div class="active-courses">
            <div class="category-card">
                <h2 class="category-title">{{$cate}}</h2>
                <h3 class="topic-title"><span class="arrow">-></span> {{$topic}}</h3>
                
                <div class="courses-grid">
                    @forEach($courses as $course)
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
                                        <i class="fas fa-calendar-alt"></i> Published at : <span class="date">{{Carbon::parse($course->publishing_date)->format('M d, Y')}}</span>
                                    </div>    
                                </div>
                                <div class="price">
                                    @if($course->price == 0)
                                        <span><i class="fas fa-dollar-sign"></i> FREE</span>
                                    @else
                                        <span><i class="fas fa-dollar-sign"></i>{{$course->price}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.header>
