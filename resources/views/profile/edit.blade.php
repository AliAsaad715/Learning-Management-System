@extends('layouts.header')

@section('title', 'Edit Profile')

@section('content')
<div class="admin-profile">
    <div class="profile-header">
        <h1 class="profile-title">Edit Profile</h1>
    </div>

    <div class="profile-card">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="profile-grid">
                <!-- Avatar Upload Section -->
            <div class="avatar-upload-container">
                @if(auth()->user()->profile_image_url)
                    <img src="{{ asset('build/assets/img/profiles/' . auth()->user()->profile_image_url) }}" 
                        alt="Profile Image" 
                        class="avatar-preview" 
                        id="avatar-preview">
                @else
                    <div class="initials-avatar" id="avatar-placeholder">
                        {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                    </div>
                @endif
                
                <div class="avatar-edit">
                    <label for="profile_image" title="Change photo">
                        <i class="fas fa-pencil-alt"></i>
                    </label>
                    <input type="file" id="profile_image" name="profile_image" accept="image/*">
                </div>
                <div class="avatar-delete">
                        <a href="{{route('profile.destroy_profile_image')}}" class="delete-image-btn" title="Delete image">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                </div>
            </div>
                <div class="profile-details">
                    <h3>Personal Information</h3>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="first_name">First Name:</label>
                        <div class="profile-detail-value">
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" required>
                            @error('first_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="last_name">Last Name:</label>
                        <div class="profile-detail-value">
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" required>
                            @error('last_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="email">Email:</label>
                        <div class="profile-detail-value">
                            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <h3 style="margin-top: 2rem;">Change Password</h3>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="current_password">Current Password:</label>
                        <div class="profile-detail-value">
                            <input type="password" id="current_password" name="current_password">
                            @error('current_password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="new_password">New Password:</label>
                        <div class="profile-detail-value">
                            <input type="password" id="new_password" name="new_password">
                            @error('new_password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="new_password_confirmation">Confirm Password:</label>
                        <div class="profile-detail-value">
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                    </div>
                    
                    <div class="buttons-edit">
                        <button type="submit" class="edit-button">Save Changes</button>
                        <a href="{{ route('profile.show') }}" class="cancel-button">Cancel</a>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview profile image before upload
    document.getElementById('profile_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profile-image-preview');
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    const initialsPreview = document.getElementById('initials-preview');
                    initialsPreview.innerHTML = `<img src="${e.target.result}" class="profile-avatar">`;
                    initialsPreview.classList.remove('initials-avatar');
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection