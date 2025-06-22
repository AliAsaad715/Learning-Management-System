<div class="admin-profile">
    <div class="profile-header">
        <h1 class="profile-title">Edit Profile</h1>
    </div>

    <div class="profile-card">
        <form wire:submit="update">
            <div class="profile-edit-grid">
                <!-- Avatar Upload Section -->
            <div class="avatar-upload-container">
                @if(auth()->user()->profile_image_url)
                    <img src="{{ asset('build/assets/img/profiles/' . auth()->user()->profile_image_url) }}" 
                        alt="Profile Image" 
                        class="avatar-preview" 
                        id="avatar-preview">
                @else
                    <img src="{{ asset('build/assets/img/anonymous_admin_icon.png') }}" 
                    alt="Profile Image" 
                    class="admin-profile-avatar">
                @endif
                
                <div class="avatar-edit">
                    <label for="profile_image" title="Change photo">
                        <i class="fas fa-pencil-alt"></i>
                    </label>
                    <input wire:model="profile_image" type="file" id="profile_image" accept="image/*">
                </div>
                <div class="avatar-delete">
                    <button wire:click="destroy_profile_image" class="delete-image-btn" title="Delete image">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
                <div class="profile-details">
                    <h3>Personal Information</h3>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="first_name">First Name:</label>
                        <div class="profile-detail-value">
                            <input wire:model="first_name" type="text" id="first_name">
                            @error('first_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="last_name">Last Name:</label>
                        <div class="profile-detail-value">
                            <input wire:model="last_name" type="text" id="last_name">
                            @error('last_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="email">Email:</label>
                        <div class="profile-detail-value">
                            <input wire:model="email" type="email" id="email">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <h3 style="margin-top: 2rem;">Change Password</h3>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="current_password">Current Password:</label>
                        <div class="profile-detail-value">
                            <input wire:model="current_password" type="password" id="current_password">
                            @error('current_password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="new_password">New Password:</label>
                        <div class="profile-detail-value">
                            <input wire:model="new_password" type="password" id="new_password">
                            @error('new_password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="profile-detail">
                        <label class="profile-detail-label" for="new_password_confirmation">Confirm Password:</label>
                        <div class="profile-detail-value">
                            <input wire:model="new_password_confirmation" type="password" id="new_password_confirmation">
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
                    const preview = document.getElementById('avatar-preview');
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    const initialsPreview = document.getElementById('avatar-placeholder');
                    initialsPreview.innerHTML = `<img src="${e.target.result}" class="profile-avatar">`;
                    initialsPreview.classList.remove('initials-avatar');
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
