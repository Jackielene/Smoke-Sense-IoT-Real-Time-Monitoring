@extends('layouts.app')

@section('content')

<div class="reservation-form">
    <form id="reservation-form" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Decorative Floating Circles -->
        <div class="decorative-circle circle-1"></div>
        <div class="decorative-circle circle-2"></div>

        <h4>Login</h4>

        <!-- Email Input -->
        <input 
            id="email" 
            type="email" 
            name="email" 
            placeholder="Enter your email"
            class="form-control @error('email') is-invalid @enderror" 
            value="{{ old('email') }}" 
            required 
            autocomplete="email" 
            autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- Password Input -->
        <input 
            id="password" 
            type="password" 
            name="password" 
            placeholder="Enter your password"
            class="form-control @error('password') is-invalid @enderror" 
            required 
            autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- Submit Button -->
        <button type="submit">Login</button>

        <!-- Sign Up Link -->
        <div class="signup-link">
            <p>Don't have an account? <a href="{{ route('register') }}">Create Account Now</a></p>
        </div>
    </form>
</div>

<style>
    .reservation-form {
        max-width: 800px;
        width: 90%;
        margin: auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .signup-link {
        text-align: center;
        margin-top: 15px;
    }

    .signup-link p {
        font-size: 14px;
        margin: 0;
    }

    .signup-link a {
        color: #f5f9fe;
        text-decoration: none;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .reservation-form {
            max-width: 100%;
            padding: 15px;
        }

        .signup-link p {
            font-size: 12px;
        }
    }
</style>

@endsection
