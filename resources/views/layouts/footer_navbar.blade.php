<footer class="footer-navbar">
    <div class="footer-container">
        <ul class="footer-menu">
            <li class="footer-item">
                <a href="{{route('home')}}" class="footer-link">
                    <div class="footer-icon-container">
                        <div class="footer-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="footer-pulse"></div>
                    </div>
                    <span class="footer-text">Home</span>
                </a>
            </li>
            <li class="footer-item">
                <a href="{{route('courses.cates_and_topics')}}" class="footer-link">
                    <div class="footer-icon-container">
                        <div class="footer-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="footer-pulse"></div>
                    </div>
                    <span class="footer-text">Courses</span>
                </a>
            </li>
            <li class="footer-item">
                <a href="{{route('users.index', ['type' => 'user'])}}" class="footer-link">
                    <div class="footer-icon-container">
                        <div class="footer-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="footer-pulse"></div>
                    </div>
                    <span class="footer-text">Users</span>
                </a>
            </li>
            <li class="footer-item">
                <a href="{{route('users.index', ['type' => 'teacher'])}}" class="footer-link">
                    <div class="footer-icon-container">
                        <div class="footer-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="footer-pulse"></div>
                    </div>
                    <span class="footer-text">Teachers</span>
                </a>
            </li>
            <li class="footer-item">
                <a href="{{route('badges.index')}}" class="footer-link">
                    <div class="footer-icon-container">
                        <div class="footer-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="footer-pulse"></div>
                    </div>
                    <span class="footer-text">Badges</span>
                </a>
            </li>
        </ul>
    </div>
</footer>