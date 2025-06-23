<x-layouts.header title="Home">
    <div class="dashboard-container">
        <h1 class="dashboard-title">Platform Insights</h1>
        
        <div class="stats-grid">
            <!-- Courses Card -->
            <x-stat-card card-name="Courses" icon-name="course_icon.png" :count="$num_of_courses" alt="course icon"/>

            <!-- Users Card -->
            <x-stat-card card-name="Students" icon-name="student_icon.png" :count="$num_of_students" alt="student icon"/>

            <!-- Teachers Card -->
            <x-stat-card card-name="Teachers" icon-name="teacher_icon.png" :count="$num_of_teachers" alt="teacher icon"/>

            <!-- Views Card -->
            <x-stat-card card-name="Total Views" icon-name="view_icon.png" :count="$num_of_views" alt="view icon"/>

            <!-- Countries Card -->
            <x-stat-card card-name="Countries" icon-name="country_icon.png" :count="$num_of_countries" alt="country icon"/>

            <!-- Topics Card -->
            <x-stat-card card-name="Topics" icon-name="topic_icon.png" :count="$num_of_topics" alt="topic icon"/>

        </div>
    </div>
</x-layouts.header>