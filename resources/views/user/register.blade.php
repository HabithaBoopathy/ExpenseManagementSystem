@extends('layouts.app')

@section('content')
<div style="background-color: #eaf4fc;" class="w-100 min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4 rounded-4" style="width: 100%; max-width: 500px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Create Your Account</h2>
            <p class="text-muted">Join us to manage your expenses better</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name') }}" 
                    required 
                    placeholder="John Doe"
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="username" 
                    placeholder="you@example.com"
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    required 
                    autocomplete="new-password" 
                    placeholder="••••••••"
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="form-control" 
                    required 
                    autocomplete="new-password" 
                    placeholder="••••••••"
                >
            </div>

            <!-- <div class="mb-3">
                <label for="monthly_budget" class="form-label">Monthly Budget</label>
                <input 
                    type="number" 
                    name="monthly_budget" 
                    id="monthly_budget" 
                    class="form-control @error('monthly_budget') is-invalid @enderror" 
                    value="{{ old('monthly_budget') }}" 
                    step="0.01" 
                    required 
                    placeholder="e.g. 1500.00"
                >
                @error('monthly_budget')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> -->

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Register</button>
            </div>
        </form>

        <p class="text-center mt-3 text-muted">
            Already have an account? 
            <a href="{{ route('login') }}">Login here</a>
        </p>
    </div>
</div>
@endsection
