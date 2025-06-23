@props(['activeTab', 'categories'])

<div class="courses-container">
        <h1 class="courses-title">Course Management</h1>
        
        <div class="courses-tabs">
            
            <!-- Tab Labels -->
            <div class="tab-labels">
                <label for="active-tab" @class(['tab', 'selected' => $activeTab === 'active_courses']) wire:click="changeTab('active_courses')">Active Courses</label>
                <label for="rejected-tab" @class(['tab', 'selected' => $activeTab === 'rejected_episodes'])wire:click="changeTab('rejected_episodes')">Rejected Episodes</label>
                <label for="pending-tab" @class(['tab', 'selected' => $activeTab === 'pending_episodes']) wire:click="changeTab('pending_episodes')">Pending Episodes</label>
            </div>

            <!-- Tab Contents -->
            <div class="tab-content-wrapper">
                @if($activeTab === 'active_courses')
                    <!-- Active Courses -->
                    @include('courses.active-courses-categories', ['categories' => $categories])
                @elseif($activeTab === 'rejected_episodes')
                    <!-- Rejected Episodes -->
                    @include('courses.rejected-episodes-categories', ['categories' => $categories])
                @elseif($activeTab === 'pending_episodes')
                    <!-- Pending Episodes -->
                    @livewire('pending-episodes')
                @endif
            </div>
        </div>
    </div>  