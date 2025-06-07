@extends('layouts.header')

@section('title', 'Home')

@section('content')
<div class="dashboard-container">
    <h1 class="dashboard-title">Platform Insights</h1>
    
    <div class="stats-grid">
        <!-- Courses Card -->
        <div class="stat-card courses">
            <div class="card-icon">
                <div class="icon-backdrop"></div>
                <div class="icon-wrapper">
                    <img src="{{asset('build\assets\img\course_icon.png')}}" alt="course icon">
                </div>
            </div>
            <h3 class="card-title">Courses</h3>
            <div class="card-value">{{$num_of_courses}}</div>
        </div>

        <!-- Users Card -->
        <div class="stat-card users">
            <div class="card-icon">
                <div class="icon-backdrop"></div>
                <div class="icon-wrapper">
                    <img src="{{asset('build\assets\img\student_icon.png')}}" alt="student icon">
                </div>
            </div>
            <h3 class="card-title">Students</h3>
            <div class="card-value">{{$num_of_students}}</div>
        </div>

        <!-- Teachers Card -->
        <div class="stat-card teachers">
            <div class="card-icon">
                <div class="icon-backdrop"></div>
                <div class="icon-wrapper">
                    <img src="{{asset('build\assets\img\teacher_icon.png')}}" alt="teacher icon">
                </div>
            </div>
            <h3 class="card-title">Teachers</h3>
            <div class="card-value">{{$num_of_teachers}}</div>
        </div>

        <!-- Views Card -->
        <div class="stat-card views">
            <div class="card-icon">
                <div class="icon-backdrop"></div>
                <div class="icon-wrapper">
                    <img src="{{asset('build\assets\img\view_icon.png')}}" alt="view icon">
                </div>
            </div>
            <h3 class="card-title">Total Views</h3>
            <div class="card-value">{{$num_of_views}}</div>
        </div>

        <!-- Countries Card -->
        <div class="stat-card countries">
            <div class="card-icon">
                <div class="icon-backdrop"></div>
                <div class="icon-wrapper">
                    <img src="{{asset('build\assets\img\country_icon.png')}}" alt="country icon">
                </div>
            </div>
            <h3 class="card-title">Countries</h3>
            <div class="card-value">{{$num_of_countries}}</div>
        </div>

        <!-- Topics Card -->
        <div class="stat-card topics">
            <div class="card-icon">
                <div class="icon-backdrop"></div>
                <div class="icon-wrapper">
                    <img src="{{asset('build\assets\img\topic_icon.png')}}" alt="topic icon">
                </div>
            </div>
            <h3 class="card-title">Topics</h3>
            <div class="card-value">{{$num_of_topics}}</div>
        </div>
    </div>
</div>
@endsection