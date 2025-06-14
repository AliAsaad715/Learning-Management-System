<!-- register.blade.php -->
@extends('layouts.auth_bg')

@section('content')
<div class="auth-container">
    <div class="auth-form">
        <h2 @class(['error-form-shrink' => $errors->any()])>Admin Registration</h2>
        <form method="POST" action="{{ route('dashboard.register') }}">
            @csrf
            
            <div @class(['form-grid', 'error-field' => $errors->has('first_name') || $errors->has('last_name')])>
                <div class="input-group">
                    <input type="text" name="first_name" id="first_name" required placeholder="First Name" value = "{{old('first_name')}}">
                </div>
                
                <div class="input-group">
                    <input type="text" name="last_name" id="last_name" required placeholder="Last Name" value = "{{old('last_name')}}">
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
                <input type="email" name="email" id="email" required placeholder="Email Address" value = "{{old('email')}}">
            </div>
            @error('email')
                <span class="error-message">
                    {{ $message }}
                </span>
            @enderror

            <div @class(['input-group', 'error-field' => $errors->has('password')])>
                <input type="password" name="password" id="password" required placeholder="Password">
            </div>
            @error('password')
                <span class="error-message">
                    {{ $message }}
                </span>
            @enderror
            
            <div @class(['input-group', 'error-field' => $errors->has('password_confirmation')])>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <span class="error-message">
                    {{ $message }}
                </span>
            @enderror

            <div @class(['input-group', 'error-field' => $errors->has('admin_secret')])>
                <input type="password" name="admin_secret" id="admin_secret" required placeholder="Admin Secret">
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
@endsection