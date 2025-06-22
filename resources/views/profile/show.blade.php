@use('Carbon\Carbon')

<x-layouts.header title="Admin Profile">
    <div class="admin-profile">
        <div class="profile-header">
            <h1 class="profile-title">My Profile</h1>
            <div class="buttons-show">
                <a href="{{ route('profile.edit') }}" class="edit-button">Edit Profile</a>
                <!-- Add Delete Account Button -->
                <form action="{{route('profile.destroy_account')}}" method="POST" class="delete-account-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-account-btn" onclick="confirmDelete()">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>

        <div class="profile-card">
            <div class="profile-grid">
                <div class="profile-avatar-container">
                    @if(auth()->user()->profile_image_url)
                        <img src="{{ asset('build/assets/img/profiles/' . auth()->user()->profile_image_url) }}" alt="Profile Image" class="admin-profile-avatar">
                    @else
                        <img src="{{ asset('build/assets/img/anonymous_admin_icon.png') }}" alt="Profile Image" class="admin-profile-avatar">
                    @endif
                </div>
                <div class="profile-details">
                    <h3>Personal Information</h3>
                    
                    <div class="profile-detail">
                        <span class="profile-detail-label">First Name:</span>
                        <span class="profile-detail-value">{{ auth()->user()->first_name }}</span>
                    </div>
                    
                    <div class="profile-detail">
                        <span class="profile-detail-label">Last Name:</span>
                        <span class="profile-detail-value">{{ auth()->user()->last_name }}</span>
                    </div>
                    
                    <div class="profile-detail">
                        <span class="profile-detail-label">Email:</span>
                        <span class="profile-detail-value">{{ auth()->user()->email }}</span>
                    </div>
                    
                    <div class="profile-detail">
                        <span class="profile-detail-label">Role:</span>
                        <span class="profile-detail-value">
                            <span class="user-role role-{{ auth()->user()->role }}">
                                {{ auth()->user()->role }}
                            </span>
                        </span>
                    </div>
                    
                    <div class="profile-detail">
                        <span class="profile-detail-label">Join Date:</span>
                        <span class="profile-detail-value">
                            {{ auth()->user()->join_date ? Carbon::parse(auth()->user()->join_date)->format('M d, Y') : 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.header>