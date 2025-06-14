<!-- login.blade.php -->
@extends('layouts.auth_bg')

@section('content')
<div class="auth-container">
    <div class="auth-form">
        <h2>Admin Login</h2>
        <form method="POST" action="{{ route('dashboard.login') }}">
            @csrf

            <div @class(['input-group', 'error-field' => $errors->has('email')])>
                <input type="email" name="email" id="email" required placeholder="Email Address" value = "{{old('email')}}">
            </div>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror   

            <div @class(['input-group', 'error-field' => $errors->has('password')])>
                <input type="password" name="password" id="password" required placeholder="Password">
            </div>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror   

            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit">Login</button>
        </form>
        <div class="link-container">
            <a class="link" href="{{route('dashboard.register')}}">Sign Up</a>
        </div>
    </div>
</div>
@endsection