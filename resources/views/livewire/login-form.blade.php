    <div class="auth-container">
        <div class="auth-form">
            <h2>Admin Login</h2>
            <form wire:submit="login">

                <div @class(['input-group', 'error-field' => $errors->has('email')])>
                    <input wire:model="email" type="email" id="email" required placeholder="Email Address">
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror   

                <div @class(['input-group', 'error-field' => $errors->has('password')])>
                    <input wire:model="password" type="password" id="password" required placeholder="Password">
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror   

                <div class="remember-me">
                    <input wire:model="remember" type="checkbox" id="remember">
                    <label for="remember">Remember Me</label>
                </div>

                <button type="submit">Login</button>
            </form>
            <div class="link-container">
                <a class="link" href="{{route('dashboard.register')}}">Sign Up</a>
            </div>
        </div>
    </div>
