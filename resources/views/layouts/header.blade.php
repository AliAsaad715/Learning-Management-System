<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darajat Edu - @yield('title')</title>
    {{-- main --}}
    <link rel="stylesheet" href="{{asset('build/assets/css/main/header.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/main/home.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/main/profile.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/main/footer_navbar.css')}}">
    {{-- courses --}}
    <link rel="stylesheet" href="{{asset('build/assets/css/courses/index.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/courses/episodes.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/courses/video.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/courses/show_course.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/courses/quiz.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/courses/rejected_courses.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/courses/pending_courses.css')}}">
    {{-- badges --}}
    <link rel="stylesheet" href="{{asset('build/assets/css/badges/index.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/badges/show.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/badges/create.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/badges/edit.css')}}">
    {{-- users --}}
    <link rel="stylesheet" href="{{asset('build/assets/css/users/index.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/users/show.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/css/users/followed_course.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>
<body>
    <nav class="navbar">
        <!-- Platform Name -->
        <div class="brand">
            <span class="gradient-text"><img src="{{asset('build/assets/img/Darajat.png')}}" alt="logo"></span>
        </div>

        <!-- Navigation Links -->
        <ul class="nav-menu">
            <li><a href="{{route('home')}}" class="nav-link">Home</a></li>
            <li><a href="{{route('courses.cates_and_topics')}}" class="nav-link">Courses</a></li>
            <li><a href="{{route('users.index', ['type' => 'user'])}}" class="nav-link">Users</a></li>
            <li><a href="{{route('users.index', ['type' => 'teacher'])}}" class="nav-link">Teachers</a></li>
            <li><a href="{{route('badges.index')}}" class="nav-link">Badges</a></li>
        </ul>

        <!-- Profile Dropdown -->
        <div class="profile-menu">
            <button class="profile-toggler">
                <div class="hamburger">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </button>
            
            <div class="dropdown-content">
                <a href="{{route('profile.show')}}" class="dropdown-item">
                    <img class="item-icon profile-icon" src="{{asset('build\assets\img\profile_icon.png')}}" alt="profile icon"></img>
                    Profile
                </a>
                <!-- Logout Button -->
                <form action="{{route('dashboard.logout')}}" method="POST">
                    @csrf    
                    <button class="dropdown-item logout-btn">
                        <img class="item-icon logout-icon" src="{{asset('build\assets\img\logout_icon.png')}}" alt="logout icon"></img>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="br"></div>

    <main class="main-content">
        @yield('content')
    </main>

    @include('layouts.footer_navbar')

    <script src="script.js">
        document.getElementById('profileToggler').addEventListener('click', function() {
            const dropdown = document.getElementById('dropdownContent');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Optional: Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownContent');
            const toggler = document.getElementById('profileToggler');
        
        if (!toggler.contains(event.target)) {
            dropdown.style.display = 'none';
            }
        });

        
        // Tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and content
                document.querySelectorAll('.tab, .tab-content').forEach(el => {
                    el.classList.remove('active');
                });
                
                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                document.querySelector(`.tab-content:nth-child(${tab.dataset.tab})`).classList.add('active');
            });
        });
    </script>
</body>
</html>