@extends('layouts.app')

@section('content')

<div class="reservation-form">
    <form id="reservation-form" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Decorative Floating Circles -->
        <div class="decorative-circle circle-1"></div>
        <div class="decorative-circle circle-2"></div>

        <h4>Register</h4>

        <!-- Name Input -->
        <input 
            id="name" 
            type="text" 
            name="name" 
            placeholder="Enter your name"
            class="form-control @error('name') is-invalid @enderror" 
            value="{{ old('name') }}" 
            required 
            autocomplete="name" 
            autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- Email Input -->
        <input 
            id="email" 
            type="email" 
            name="email" 
            placeholder="Enter your email"
            class="form-control @error('email') is-invalid @enderror" 
            value="{{ old('email') }}" 
            required 
            autocomplete="email">
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
            autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- Confirm Password Input -->
        <input 
            id="password-confirm" 
            type="password" 
            name="password_confirmation" 
            placeholder="Confirm your password"
            required 
            autocomplete="new-password">

        <!-- Submit Button -->
        <button type="submit">Register</button>
    </form>
</div>

@endsection
