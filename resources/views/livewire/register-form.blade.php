<div class="auth-container">
    <div class="auth-form">
        <h2 @class(['error-form-shrink' => $errors->any()])>Admin Registration</h2>
        <form wire:submit="register">            
            <div @class(['form-grid', 'error-field' => $errors->has('first_name') || $errors->has('last_name')])>
                <div class="input-group">
                    <input wire:model="first_name" type="text" id="first_name" required placeholder="First Name">
                </div>
                
                <div class="input-group">
                    <input wire:model="last_name" type="text" id="last_name" required placeholder="Last Name">
                </div>
            </div>
            <div class="error-message">
                @error('first_name')
                        <div>{{ $message }}</div>
                @enderror
                @error('last_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div @class(['input-group', 'error-field' => $errors->has('email')])>
                <input wire:model="email" type="email" id="email" required placeholder="Email Address">
            </div>
            @error('email')
                <span class="error-message">
                    {{ $message }}
                </span>
            @enderror

            <div @class(['input-group', 'error-field' => $errors->has('password')])>
                <input wire:model="password" type="password" id="password" required placeholder="Password">
            </div>
            @error('password')
                <span class="error-message">
                    {{ $message }}
                </span>
            @enderror
            
            <div @class(['input-group', 'error-field' => $errors->has('password_confirmation')])>
                <input wire:model="password_confirmation" type="password" id="password_confirmation" required placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <span class="error-message">
                    {{ $message }}
                </span>
            @enderror

            <div @class(['input-group', 'error-field' => $errors->has('admin_secret')])>
                <input wire:model="admin_secret" type="password" id="admin_secret" required placeholder="Admin Secret">
            </div>
            @error('admin_secret')
                <span class="error-message">
                    {{ $message }}
                </span>
            @enderror

            <button type="submit">Register</button>
            <div class="link-container">
                <a class="link" href="{{route('dashboard.login')}}">Already have an account?</a>
            </div>
        </form>
    </div>
</div>
